<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogimages extends Model
{
    use HasFactory;
    protected $fillable = ['gallery', 'caption', 'news_id'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function imageUrl(): string
    {
        if (empty($this->gallery)) {
            return asset('assets/img/gallery/gallery-1.jpg');
        }

        return asset('storage/images/galleries/' . ltrim($this->gallery, '/'));
    }
}
