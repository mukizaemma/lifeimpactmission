<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\InstagramService;
use Illuminate\Http\JsonResponse;

class InstagramFeedController extends Controller
{
    public function __invoke(InstagramService $instagramService): JsonResponse
    {
        $setting = Setting::query()->first();
        $profile = trim((string) ($setting?->instagram ?? ''));
        if ($profile === '') {
            $profile = 'https://www.instagram.com/';
        }

        $posts = collect($instagramService->getFeedPosts(6))
            ->map(fn (array $post) => [
                'embed_url' => $post['embed_url'] ?? null,
                'image' => $post['image'] ?? null,
                'permalink' => $post['permalink'] ?? null,
                'media_type' => $post['media_type'] ?? 'post',
                'caption' => $post['caption'] ?? '',
            ])
            ->values();

        return response()
            ->json([
                'profile' => $profile,
                'posts' => $posts,
            ])
            ->header('Cache-Control', 'public, max-age=300');
    }
}
