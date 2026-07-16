<?php

namespace App\Livewire\Admin;

use App\Models\Image;
use App\Models\Program;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Image Gallery')]
class Gallery extends Component
{
    public function render()
    {
        return view('admin.gallery', [
            'images' => Image::latest()->get(),
            'programs' => Program::latest()->get(),
        ]);
    }
}