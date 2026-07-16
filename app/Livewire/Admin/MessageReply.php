<?php

namespace App\Livewire\Admin;

use App\Models\Message;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Reply Message')]
class MessageReply extends Component
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('admin.emails.messageReply', [
            'data' => Message::findOrFail($this->id),
        ]);
    }
}