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
    public function render()
    {
        return view('admin.dashboard', [
            'slides' => Slide::latest()->get(),
            'messages' => Message::all(),
        ]);
    }
}