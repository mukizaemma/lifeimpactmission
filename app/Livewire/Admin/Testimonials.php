<?php

namespace App\Livewire\Admin;

use App\Models\Testimony;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Testimonials')]
class Testimonials extends Component
{
    public function render()
    {
        return view('admin.testimonies', [
            'data' => Testimony::latest()->get(),
        ]);
    }
}