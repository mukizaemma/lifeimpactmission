<?php

namespace App\Livewire\Frontend;

use App\Models\Background;
use App\Models\Program;
use App\Models\Testimony;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Testimonials')]
class Testimonials extends Component
{
    public function render()
    {
        return view('frontend.testimonials', [
            'testimonials' => Testimony::latest()->get(),
            'programs' => Program::latest()->get(),
            'about' => Background::first(),
        ]);
    }
}