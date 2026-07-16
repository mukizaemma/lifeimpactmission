<?php

if (! function_exists('ilm_image_url')) {
    /**
     * Build a public URL for an image stored under storage/app/public.
     *
     * Accepts either:
     * - ilm_image_url('images/projects', $filename)
     * - ilm_image_url('projects', $filename)
     * - ilm_image_url($filename) when $filename already includes images/...
     */
    function ilm_image_url(?string $folderOrFile, ?string $filename = null): string
    {
        $fallback = asset('assets/img/team/team-1.jpg');

        if ($filename === null) {
            $path = trim(str_replace('\\', '/', (string) $folderOrFile));
            if ($path === '') {
                return $fallback;
            }

            $path = ltrim($path, '/');
            if (str_starts_with($path, 'storage/')) {
                return asset($path);
            }
            if (! str_starts_with($path, 'images/')) {
                $path = 'images/' . $path;
            }

            return asset('storage/' . $path);
        }

        $file = trim(str_replace('\\', '/', (string) $filename));
        if ($file === '') {
            return $fallback;
        }

        $file = ltrim($file, '/');
        $folder = trim(str_replace(['\\', 'storage/', 'public/'], ['/', '', ''], (string) $folderOrFile), '/');

        if ($folder === '' || $folder === 'images') {
            // Avoid images/images/... when callers pass the root images folder.
            if (str_starts_with($file, 'images/')) {
                return asset('storage/' . $file);
            }

            return asset('storage/images/' . $file);
        }

        if (! str_starts_with($folder, 'images/')) {
            $folder = 'images/' . $folder;
        }

        // Avoid duplicating folder if DB already stored a path.
        if (str_starts_with($file, $folder . '/')) {
            return asset('storage/' . $file);
        }

        return asset('storage/' . $folder . '/' . $file);
    }
}

if (! function_exists('ilm_default_page_header_url')) {
    /**
     * Site-wide default page hero image when a page has no header image set.
     * Prefers Background.image2 ("pages header image"), then other background photos,
     * then a built-in theme image.
     */
    function ilm_default_page_header_url(): string
    {
        $about = null;

        try {
            if (function_exists('view') && app()->bound('view')) {
                $shared = \Illuminate\Support\Facades\View::shared('about');
                if (is_object($shared)) {
                    $about = $shared;
                }
            }
        } catch (\Throwable $e) {
            $about = null;
        }

        if (! $about && class_exists(\App\Models\Background::class)) {
            try {
                $about = \App\Models\Background::query()->first();
            } catch (\Throwable $e) {
                $about = null;
            }
        }

        foreach (['image2', 'image1', 'image'] as $field) {
            $value = is_object($about) ? ($about->{$field} ?? null) : null;
            if (! empty($value)) {
                return ilm_image_url('images', $value);
            }
        }

        return asset('assets/img/cta/cta-bg-3.jpg');
    }
}

if (! function_exists('ilm_page_header_url')) {
    /**
     * Resolve hero image: page-specific header → site default → theme fallback.
     */
    function ilm_page_header_url($header = null): string
    {
        if (is_object($header) && method_exists($header, 'imageUrl')) {
            $url = $header->imageUrl();
            if (! empty($url)) {
                return $url;
            }
        }

        return ilm_default_page_header_url();
    }
}
