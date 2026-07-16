<?php

namespace App\Livewire\Admin;

use App\Models\Program;
use App\Models\Video;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Videos')]
class Videos extends Component
{
    public function render()
    {
        return view('admin.videos', [
            'data' => Video::with('program')->latest()->get(),
            'programs' => Program::latest()->get(),
        ]);
    }
}