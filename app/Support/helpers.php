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
