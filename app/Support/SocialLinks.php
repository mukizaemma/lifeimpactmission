<?php

namespace App\Support;

use App\Models\Setting;

class SocialLinks
{
    public static function forSetting(?Setting $setting): array
    {
        if (! $setting) {
            return [];
        }

        $networks = [
            ['field' => 'facebook', 'icon' => 'fab fa-facebook-f', 'label' => 'Facebook'],
            ['field' => 'instagram', 'icon' => 'fab fa-instagram', 'label' => 'Instagram'],
            ['field' => 'linkedin', 'icon' => 'fab fa-linkedin-in', 'label' => 'LinkedIn'],
            ['field' => 'tiktok', 'icon' => 'fab fa-tiktok', 'label' => 'TikTok'],
            ['field' => 'youtube', 'icon' => 'fab fa-youtube', 'label' => 'YouTube'],
            ['field' => 'linktree', 'icon' => 'fas fa-link', 'label' => 'Linktree'],
        ];

        $links = [];

        foreach ($networks as $network) {
            $url = trim((string) ($setting->{$network['field']} ?? ''));

            if ($url === '') {
                continue;
            }

            $links[] = [
                'url' => $url,
                'icon' => $network['icon'],
                'label' => $network['label'],
            ];
        }

        return $links;
    }
}
