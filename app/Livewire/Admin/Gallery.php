<?php

namespace App\Livewire\Admin;

use App\Models\Image;
use App\Models\Program;
use Livewire\Attributes\Title;

#[Title('Image Gallery')]
class Gallery extends AdminComponent
{
    public function render()
    {
        return $this->adminView('admin.gallery', [
            'images' => Image::latest()->get(),
            'programs' => Program::latest()->get(),
        ]);
    }
}