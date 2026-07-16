<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use InvalidArgumentException;
use RuntimeException;

class ImageUploadService
{
    public const MIN_BYTES = 300 * 1024; // 300KB
    public const MAX_BYTES = 700 * 1024; // 700KB

    public const MIN_KB = 300;
    public const MAX_KB = 700;

    /**
     * Resize, compress, validate, and store an uploaded image.
     *
     * @param  bool  $enforceMin  When false (e.g. logos), only the max size is enforced.
     */
    public function store(
        UploadedFile $file,
        string $directory,
        string $disk = 'public',
        bool $enforceMin = true,
        int $maxWidth = 1600,
        int $maxHeight = 1600
    ): string {
        $binary = $this->optimize($file, $maxWidth, $maxHeight, $enforceMin);
        $extension = 'jpg';
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) ?: 'image')
            . '_' . time() . '_' . Str::random(5) . '.' . $extension;

        $directory = trim(str_replace('public/', '', $directory), '/');
        $path = trim($directory . '/' . $filename, '/');

        Storage::disk($disk)->put($path, $binary);

        return $filename;
    }

    /**
     * Optimize an uploaded image into JPEG binary within the allowed size range.
     */
    public function optimize(
        UploadedFile $file,
        int $maxWidth = 1600,
        int $maxHeight = 1600,
        bool $enforceMin = true
    ): string {
        if (! extension_loaded('gd')) {
            throw new RuntimeException('GD extension is required to process images.');
        }

        $sourcePath = $file->getRealPath();
        $mime = $file->getMimeType() ?: mime_content_type($sourcePath);
        $image = $this->createImageResource($sourcePath, $mime);

        if (! $image) {
            throw new InvalidArgumentException('Unsupported or corrupted image file.');
        }

        $width = imagesx($image);
        $height = imagesy($image);
        $scale = min($maxWidth / max($width, 1), $maxHeight / max($height, 1), 1);
        $newWidth = max(1, (int) round($width * $scale));
        $newHeight = max(1, (int) round($height * $scale));

        if ($newWidth !== $width || $newHeight !== $height) {
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            $white = imagecolorallocate($resized, 255, 255, 255);
            imagefill($resized, 0, 0, $white);
            imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($image);
            $image = $resized;
        }

        $binary = $this->encodeWithinLimits($image, $enforceMin);
        imagedestroy($image);

        return $binary;
    }

    public function validationRules(bool $enforceMin = true, bool $required = false): array
    {
        $rules = [
            $required ? 'required' : 'nullable',
            'image',
            'mimes:jpeg,jpg,png,gif,webp',
            'max:' . self::MAX_KB,
        ];

        if ($enforceMin) {
            $rules[] = function ($attribute, $value, $fail) {
                if (! $value instanceof UploadedFile) {
                    return;
                }
                // Client may still send originals; final size is checked after optimize.
                if ($value->getSize() > self::MAX_BYTES) {
                    $fail('Each image must be ' . self::MIN_KB . 'KB–' . self::MAX_KB . 'KB. This file is larger than ' . self::MAX_KB . 'KB.');
                }
            };
        }

        return $rules;
    }

    public static function hintText(bool $enforceMin = true): string
    {
        if ($enforceMin) {
            return 'Required size: ' . self::MIN_KB . 'KB – ' . self::MAX_KB . 'KB. Images are resized automatically before upload.';
        }

        return 'Maximum size: ' . self::MAX_KB . 'KB. Images are resized automatically before upload.';
    }

    private function createImageResource(string $path, ?string $mime)
    {
        return match (true) {
            str_contains((string) $mime, 'jpeg'), str_contains((string) $mime, 'jpg') => @imagecreatefromjpeg($path),
            str_contains((string) $mime, 'png') => @imagecreatefrompng($path),
            str_contains((string) $mime, 'gif') => @imagecreatefromgif($path),
            str_contains((string) $mime, 'webp') && function_exists('imagecreatefromwebp') => @imagecreatefromwebp($path),
            default => false,
        };
    }

    private function encodeWithinLimits($image, bool $enforceMin): string
    {
        $qualities = [88, 82, 76, 70, 64, 58, 52, 46, 40];
        $bestUnderMax = null;

        foreach ($qualities as $quality) {
            $binary = $this->jpegBinary($image, $quality);
            $size = strlen($binary);

            if ($size <= self::MAX_BYTES) {
                $bestUnderMax = $binary;
                if (! $enforceMin || $size >= self::MIN_BYTES) {
                    return $binary;
                }
            }
        }

        if ($bestUnderMax !== null) {
            if ($enforceMin && strlen($bestUnderMax) < self::MIN_BYTES) {
                throw new InvalidArgumentException(
                    'Image is below ' . self::MIN_KB . 'KB after processing. Please upload a higher-resolution photo (' . self::MIN_KB . 'KB–' . self::MAX_KB . 'KB).'
                );
            }

            return $bestUnderMax;
        }

        throw new InvalidArgumentException(
            'Image could not be compressed under ' . self::MAX_KB . 'KB. Please use a smaller photo.'
        );
    }

    private function jpegBinary($image, int $quality): string
    {
        ob_start();
        imagejpeg($image, null, $quality);
        $binary = ob_get_clean();

        if ($binary === false || $binary === '') {
            throw new RuntimeException('Failed to encode image.');
        }

        return $binary;
    }
}
