<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InstagramService
{
    public function getLatestPost(): ?array
    {
        return Cache::remember('instagram_latest_post', now()->addHour(), function () {
            return $this->fetchLatestPost();
        });
    }

    public function clearCache(): void
    {
        Cache::forget('instagram_latest_post');
    }

    public function parseUrl(string $url): array
    {
        $url = trim($url);
        $type = 'post';
        $shortcode = null;

        if (preg_match('#instagram\.com/(?:reel|reels)/([A-Za-z0-9_-]+)#i', $url, $matches)) {
            $type = 'reel';
            $shortcode = $matches[1];
        } elseif (preg_match('#instagram\.com/p/([A-Za-z0-9_-]+)#i', $url, $matches)) {
            $type = 'post';
            $shortcode = $matches[1];
        }

        $embedUrl = $shortcode
            ? ($type === 'reel'
                ? "https://www.instagram.com/reel/{$shortcode}/embed"
                : "https://www.instagram.com/p/{$shortcode}/embed")
            : null;

        return [
            'type' => $type,
            'shortcode' => $shortcode,
            'permalink' => $url,
            'embed_url' => $embedUrl,
        ];
    }

    protected function fetchLatestPost(): ?array
    {
        $token = config('services.instagram.access_token');
        $userId = config('services.instagram.user_id');

        if ($token && $userId) {
            $fromApi = $this->fetchFromGraphApi($token, $userId);
            if ($fromApi) {
                return $fromApi;
            }
        }

        $setting = Setting::first();
        $postUrl = $setting?->instagram_post_url;

        if ($postUrl) {
            return $this->fetchFromUrl($postUrl);
        }

        return null;
    }

    protected function fetchFromUrl(string $postUrl): ?array
    {
        $parsed = $this->parseUrl($postUrl);
        $oembed = $this->fetchFromOembed($postUrl);

        $mediaType = $parsed['type'];
        if ($oembed && ! empty($oembed['media_type']) && $oembed['media_type'] !== 'post') {
            $mediaType = $oembed['media_type'];
        }

        return array_filter([
            'image' => $oembed['image'] ?? null,
            'permalink' => $parsed['permalink'],
            'caption' => $oembed['caption'] ?? '',
            'media_type' => $mediaType,
            'embed_url' => $parsed['embed_url'],
            'shortcode' => $parsed['shortcode'],
            'timestamp' => $oembed['timestamp'] ?? null,
        ], fn ($value) => $value !== null && $value !== '');
    }

    protected function fetchFromGraphApi(string $token, string $userId): ?array
    {
        try {
            $response = Http::timeout(8)->get("https://graph.instagram.com/{$userId}/media", [
                'fields' => 'id,caption,media_type,media_url,permalink,thumbnail_url,timestamp',
                'limit' => 1,
                'access_token' => $token,
            ]);

            if (! $response->successful()) {
                return null;
            }

            $item = $response->json('data.0');

            if (! $item) {
                return null;
            }

            $graphType = strtolower($item['media_type'] ?? 'image');
            $mediaType = in_array($graphType, ['video', 'reels'], true) ? 'reel' : 'post';
            $permalink = $item['permalink'] ?? '';
            $parsed = $permalink ? $this->parseUrl($permalink) : ['embed_url' => null, 'type' => $mediaType];

            $imageUrl = in_array($graphType, ['video', 'reels'], true)
                ? ($item['thumbnail_url'] ?? $item['media_url'])
                : $item['media_url'];

            return [
                'image' => $imageUrl,
                'permalink' => $permalink,
                'caption' => $item['caption'] ?? '',
                'media_type' => $parsed['type'] ?? $mediaType,
                'embed_url' => $parsed['embed_url'],
                'shortcode' => $parsed['shortcode'] ?? null,
                'timestamp' => $item['timestamp'] ?? null,
            ];
        } catch (\Throwable $e) {
            Log::warning('Instagram Graph API fetch failed: ' . $e->getMessage());

            return null;
        }
    }

    protected function fetchFromOembed(string $postUrl): ?array
    {
        try {
            $response = Http::timeout(8)->get('https://api.instagram.com/oembed', [
                'url' => $postUrl,
                'omitscript' => true,
                'maxwidth' => 640,
            ]);

            if (! $response->successful()) {
                return null;
            }

            $data = $response->json();
            $parsed = $this->parseUrl($postUrl);

            return [
                'image' => $data['thumbnail_url'] ?? null,
                'caption' => $data['title'] ?? ($data['author_name'] ?? ''),
                'media_type' => $parsed['type'],
                'timestamp' => null,
            ];
        } catch (\Throwable $e) {
            Log::warning('Instagram oEmbed fetch failed: ' . $e->getMessage());

            return null;
        }
    }
}
