<?php

namespace App\Livewire\Frontend;

use App\Models\Background;
use App\Models\Program;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Campaigns')]
class Campaigns extends Component
{
    public function render()
    {
        return view('frontend.campaigns', [
            'about' => Background::first(),
            'programs' => Program::oldest()->get(),
        ]);
    }
}