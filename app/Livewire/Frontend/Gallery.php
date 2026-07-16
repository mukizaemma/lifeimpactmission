<?php

namespace App\Livewire\Frontend;

use App\Models\Image;
use App\Models\Program;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Image Gallery')]
class Gallery extends Component
{
    public function render()
    {
        return view('frontend.gallery', [
            'gallery' => Image::with('program')->latest()->get(),
            'programs' => Program::with('images')->latest()->get(),
        ]);
    }
}