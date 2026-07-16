<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Events')]
class Events extends Component
{
    public function render()
    {
        return view('admin.events', [
            'events' => Event::latest()->get(),
        ]);
    }
}