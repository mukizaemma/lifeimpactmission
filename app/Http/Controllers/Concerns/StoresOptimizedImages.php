<?php

namespace App\Http\Controllers\Concerns;

use App\Services\ImageUploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

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

        try {
            $filename = $service->store($file, $directory, $disk, $enforceMin);
        } catch (InvalidArgumentException $e) {
            throw $e;
        }

        if ($oldFilename) {
            $oldPath = $directory . '/' . ltrim($oldFilename, '/');
            if (Storage::disk($disk)->exists($oldPath)) {
                Storage::disk($disk)->delete($oldPath);
            }
        }

        return $filename;
    }
}
