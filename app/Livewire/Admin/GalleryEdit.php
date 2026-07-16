<?php

namespace App\Livewire\Admin;

use App\Models\Image;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Edit Gallery Image')]
class GalleryEdit extends Component
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('admin.galleryUpdate', [
            'data' => Image::findOrFail($this->id),
        ]);
    }
}