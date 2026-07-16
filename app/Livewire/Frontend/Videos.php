<?php

namespace App\Livewire\Frontend;

use App\Models\Video;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Videos Gallery')]
class Videos extends Component
{
    public function render()
    {
        return view('frontend.videos', [
            'videos' => Video::with('program')
                ->where('status', 'Active')
                ->orderBy('sort_order')
                ->latest()
                ->get(),
        ]);
    }
}