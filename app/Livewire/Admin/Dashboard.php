<?php

namespace App\Livewire\Admin;

use App\Models\Message;
use App\Models\Slide;
use Livewire\Attributes\Title;

#[Title('Messages')]
class Dashboard extends AdminComponent
{
    public function deleteMessage(int $id): void
    {
        Message::whereKey($id)->delete();
        session()->flash('success', 'Message deleted.');
    }

    public function clearAllMessages(): void
    {
        Message::query()->delete();
        session()->flash('success', 'All visitor messages have been removed.');
    }

    public function render()
    {
        return $this->adminView('admin.dashboard', [
            'slides' => Slide::latest()->get(),
            'messages' => Message::latest()->get(),
        ]);
    }
}
