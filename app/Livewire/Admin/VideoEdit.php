<?php

namespace App\Livewire\Admin;

use App\Models\Program;
use App\Models\Video;
use Livewire\Attributes\Title;

#[Title('Edit Video')]
class VideoEdit extends AdminComponent
{
    public $recordId;

    public function mount($id): void
    {
        $this->recordId = $id;
    }

    public function render()
    {
        return $this->adminView('admin.videoUpdate', [
            'data' => Video::findOrFail($this->recordId),
            'programs' => Program::latest()->get(),
        ]);
    }
}