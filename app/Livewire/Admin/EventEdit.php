<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Edit Event')]
class EventEdit extends Component
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('admin.eventUpdate', [
            'data' => Event::findOrFail($this->id),
        ]);
    }
}