<?php

namespace App\Livewire\Admin;

use App\Models\Program;
use App\Models\Video;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Edit Video')]
class VideoEdit extends Component
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('admin.videoUpdate', [
            'data' => Video::findOrFail($this->id),
            'programs' => Program::latest()->get(),
        ]);
    }
}