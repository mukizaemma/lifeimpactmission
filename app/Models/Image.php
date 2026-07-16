<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table= "images";
    protected $fillable = [
        'program_id',
        'caption',
        'image'
    ];

    public function program(){
        return $this->belongsTo(Program::class);
    }

    public function imageUrl(): string
    {
        if (empty($this->image)) {
            return asset('assets/img/gallery/gallery-1.jpg');
        }

        return asset('storage/images/gallery/' . ltrim($this->image, '/'));
    }
}
