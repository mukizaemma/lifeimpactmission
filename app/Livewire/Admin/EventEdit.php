<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Attributes\Title;

#[Title('Edit Event')]
class EventEdit extends AdminComponent
{
    public $recordId;

    public function mount($id): void
    {
        $this->recordId = $id;
    }

    public function render()
    {
        return $this->adminView('admin.eventUpdate', [
            'data' => Event::findOrFail($this->recordId),
        ]);
    }
}