<?php

namespace App\Livewire\Admin;

use App\Models\Image;
use Livewire\Attributes\Title;

#[Title('Edit Gallery Image')]
class GalleryEdit extends AdminComponent
{
    public $recordId;

    public function mount($id): void
    {
        $this->recordId = $id;
    }

    public function render()
    {
        return $this->adminView('admin.galleryUpdate', [
            'data' => Image::findOrFail($this->recordId),
        ]);
    }
}