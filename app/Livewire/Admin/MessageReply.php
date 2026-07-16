<?php

namespace App\Livewire\Admin;

use App\Models\Message;
use Livewire\Attributes\Title;

#[Title('Reply Message')]
class MessageReply extends AdminComponent
{
    public $recordId;

    public function mount($id): void
    {
        $this->recordId = $id;
    }

    public function render()
    {
        return $this->adminView('admin.emails.messageReply', [
            'data' => Message::findOrFail($this->recordId),
        ]);
    }
}