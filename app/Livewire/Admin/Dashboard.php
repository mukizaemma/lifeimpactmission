<?php

namespace App\Livewire\Admin;

use App\Models\Message;
use App\Models\Slide;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Messages')]
class Dashboard extends Component
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
        return view('admin.dashboard', [
            'slides' => Slide::latest()->get(),
            'messages' => Message::latest()->get(),
        ]);
    }
}
