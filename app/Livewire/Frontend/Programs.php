<?php

namespace App\Livewire\Frontend;

use App\Models\Activity;
use App\Models\Background;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Our Programs')]
class Programs extends Component
{
    public function render()
    {
        return view('frontend.programs', [
            'programs' => Activity::oldest()->get(),
            'about' => Background::first(),
        ]);
    }
}