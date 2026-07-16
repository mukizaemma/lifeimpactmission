<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'caption',
        'video_url',
        'thumbnail',
        'program_id',
        'status',
        'sort_order',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function thumbnailUrl(): string
    {
        $embedId = $this->youtubeId();
        if ($embedId) {
            return 'https://img.youtube.com/vi/' . $embedId . '/hqdefault.jpg';
        }

        return asset('assets/img/gallery/gallery-1.jpg');
    }

    public function youtubeId(): ?string
    {
        if (empty($this->video_url)) {
            return null;
        }

        $url = trim($this->video_url);

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_-]{6,})/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function videoEmbedUrl(): ?string
    {
        $id = $this->youtubeId();
        if ($id) {
            return 'https://www.youtube.com/embed/' . $id;
        }

        $url = trim((string) $this->video_url);
        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        return null;
    }
}
