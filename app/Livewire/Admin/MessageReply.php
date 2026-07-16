<?php

namespace App\Livewire\Admin;

use App\Models\Message;
use Livewire\Attributes\Title;

#[Title('Reply Message')]
class MessageReply extends AdminComponent
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return $this->adminView('admin.emails.messageReply', [
            'data' => Message::findOrFail($this->id),
        ]);
    }
}