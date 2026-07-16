<?php

namespace App\Livewire\Frontend;

use App\Models\Event;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Upcoming Events')]
class Events extends Component
{
    public function render()
    {
        return view('frontend.events', [
            'events' => Event::where('status', 'Active')->latest()->get(),
        ]);
    }
}