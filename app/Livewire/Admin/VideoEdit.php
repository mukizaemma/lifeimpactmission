<?php

namespace App\Livewire\Admin;

use App\Models\Program;
use App\Models\Video;
use Livewire\Attributes\Title;

#[Title('Edit Video')]
class VideoEdit extends AdminComponent
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return $this->adminView('admin.videoUpdate', [
            'data' => Video::findOrFail($this->id),
            'programs' => Program::latest()->get(),
        ]);
    }
}