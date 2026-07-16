<?php

namespace App\Livewire\Admin;

use App\Models\Slide;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Slides')]
class Slides extends Component
{
    public function render()
    {
        return view('admin.slides', [
            'slides' => Slide::latest()->get(),
        ]);
    }
}