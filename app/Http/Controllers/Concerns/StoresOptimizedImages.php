<?php

namespace App\Http\Controllers\Concerns;

use App\Services\ImageUploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait StoresOptimizedImages
{
    protected function storeOptimizedImage(
        UploadedFile $file,
        string $directory,
        bool $enforceMin = true,
        ?string $oldFilename = null,
        string $disk = 'public'
    ): string {
        $service = app(ImageUploadService::class);
        $directory = trim(str_replace(['public/', 'storage/'], '', $directory), '/');

        $filename = $service->store($file, $directory, $disk, $enforceMin);

        if ($oldFilename) {
            $oldBasename = ltrim(str_replace(['\\', 'storage/', 'public/'], ['/', '', ''], $oldFilename), '/');
            if (str_starts_with($oldBasename, $directory . '/')) {
                $oldBasename = substr($oldBasename, strlen($directory) + 1);
            }
            $oldPath = $directory . '/' . ltrim($oldBasename, '/');
            if ($oldBasename !== '' && Storage::disk($disk)->exists($oldPath)) {
                Storage::disk($disk)->delete($oldPath);
            }
        }

        return $filename;
    }
}
