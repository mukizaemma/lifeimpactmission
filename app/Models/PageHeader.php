<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageHeader extends Model
{
    protected $fillable = [
        'page_key',
        'label',
        'title',
        'subtitle',
        'image',
    ];

    public function imageUrl(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return asset('storage/images/headers/' . $this->image);
    }
}
