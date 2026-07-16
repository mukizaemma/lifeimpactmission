<?php

namespace App\Livewire\Frontend;

use App\Models\Background;
use App\Models\Mother;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Mothers')]
class Mothers extends Component
{
    public function render()
    {
        return view('frontend.mothers', [
            'mothers' => Mother::where('status', 'Active')->oldest()->get(),
            'about' => Background::first(),
        ]);
    }
}