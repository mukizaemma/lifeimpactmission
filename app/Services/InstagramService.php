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
        $posts = $this->getFeedPosts(1);

        return $posts[0] ?? null;
    }

    /**
     * Recent posts from the org Instagram account for on-page viewing.
     * Prefer Graph API (true account feed). Fall back to admin-curated post URLs.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getFeedPosts(int $limit = 6): array
    {
        $limit = max(1, min($limit, 12));

        return Cache::remember("instagram_feed_posts_{$limit}", now()->addHour(), function () use ($limit) {
            return $this->fetchFeedPosts($limit);
        });
    }

    public function clearCache(): void
    {
        Cache::forget('instagram_latest_post');

        for ($i = 1; $i <= 12; $i++) {
            Cache::forget("instagram_feed_posts_{$i}");
        }
    }

    public function parseUrl(string $url): array
    {
        $url = trim($url);
        $type = 'post';
        $shortcode = null;

        if (preg_match('#instagram\.com/(?:reel|reels)/([A-Za-z0-9_-]+)#i', $url, $matches)) {
            $type = 'reel';
            $shortcode = $matches[1];
        } elseif (preg_match('#instagram\.com/p/([A-Za-z0-9_-]+)/?#i', $url, $matches)) {
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

    /**
     * @return array<int, string>
     */
    public function settingPostUrls(?Setting $setting = null): array
    {
        $setting ??= Setting::first();
        $raw = (string) ($setting?->instagram_post_url ?? '');

        if (trim($raw) === '') {
            return [];
        }

        $parts = preg_split('/[\s,]+/', $raw) ?: [];

        return collect($parts)
            ->map(fn ($url) => trim($url))
            ->filter(fn ($url) => $url !== '' && $this->isInstagramPostUrl($url))
            ->unique()
            ->values()
            ->all();
    }

    public function isInstagramPostUrl(string $url): bool
    {
        return (bool) preg_match('#^https?://(www\.)?instagram\.com/(p|reel|reels)/[A-Za-z0-9_-]+#i', trim($url));
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function fetchFeedPosts(int $limit): array
    {
        $token = config('services.instagram.access_token');
        $userId = config('services.instagram.user_id');

        if ($token && $userId) {
            $fromApi = $this->fetchManyFromGraphApi($token, $userId, $limit);
            if (! empty($fromApi)) {
                return $fromApi;
            }
        }

        $urls = $this->settingPostUrls();
        $posts = [];

        foreach (array_slice($urls, 0, $limit) as $url) {
            $post = $this->fetchFromUrl($url);
            if ($post) {
                $posts[] = $post;
            }
        }

        return $posts;
    }

    protected function fetchFromUrl(string $postUrl): ?array
    {
        $parsed = $this->parseUrl($postUrl);
        if (empty($parsed['embed_url'])) {
            return null;
        }

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

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function fetchManyFromGraphApi(string $token, string $userId, int $limit): array
    {
        try {
            $response = Http::timeout(10)->get("https://graph.instagram.com/{$userId}/media", [
                'fields' => 'id,caption,media_type,media_url,permalink,thumbnail_url,timestamp',
                'limit' => $limit,
                'access_token' => $token,
            ]);

            if (! $response->successful()) {
                return [];
            }

            $items = $response->json('data') ?? [];
            $posts = [];

            foreach ($items as $item) {
                $mapped = $this->mapGraphItem($item);
                if ($mapped) {
                    $posts[] = $mapped;
                }
            }

            return $posts;
        } catch (\Throwable $e) {
            Log::warning('Instagram Graph API feed fetch failed: ' . $e->getMessage());

            return [];
        }
    }

    protected function mapGraphItem(array $item): ?array
    {
        $permalink = $item['permalink'] ?? '';
        if ($permalink === '') {
            return null;
        }

        $graphType = strtolower($item['media_type'] ?? 'image');
        $mediaType = in_array($graphType, ['video', 'reels'], true) ? 'reel' : 'post';
        $parsed = $this->parseUrl($permalink);

        $imageUrl = in_array($graphType, ['video', 'reels'], true)
            ? ($item['thumbnail_url'] ?? $item['media_url'] ?? null)
            : ($item['media_url'] ?? null);

        return array_filter([
            'image' => $imageUrl,
            'permalink' => $permalink,
            'caption' => $item['caption'] ?? '',
            'media_type' => $parsed['type'] ?? $mediaType,
            'embed_url' => $parsed['embed_url'],
            'shortcode' => $parsed['shortcode'] ?? null,
            'timestamp' => $item['timestamp'] ?? null,
        ], fn ($value) => $value !== null && $value !== '');
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
