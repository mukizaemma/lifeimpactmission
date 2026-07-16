<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Mother extends Model
{
    use HasFactory;

    protected $fillable = [
        'names',
        'slug',
        'title',
        'location',
        'program',
        'description',
        'story',
        'video_url',
        'quote',
        'image',
        'status',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function imageUrl(): string
    {
        if (empty($this->image)) {
            return asset('assets/img/team/team-1.jpg');
        }

        return asset('storage/images/mothers/' . ltrim($this->image, '/'));
    }

    public function videoEmbedUrl(): ?string
    {
        if (empty($this->video_url)) {
            return null;
        }

        $url = trim($this->video_url);

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_-]{6,})/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        return null;
    }

    public static function makeSlug(string $names): string
    {
        $base = Str::slug($names) ?: 'mother';
        $slug = $base;
        $i = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
