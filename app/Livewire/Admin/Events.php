<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Attributes\Title;

#[Title('Events')]
class Events extends AdminComponent
{
    public function render()
    {
        return $this->adminView('admin.events', [
            'events' => Event::latest()->get(),
        ]);
    }
}