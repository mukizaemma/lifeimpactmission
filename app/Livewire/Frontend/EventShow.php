<?php

namespace App\Livewire\Frontend;

use App\Models\Event;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Event')]
class EventShow extends Component
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $event = Event::where('slug', $this->slug)->firstOrFail();

        view()->share('title', $event->title);

        return view('frontend.event', [
            'event' => $event,
        ]);
    }
}