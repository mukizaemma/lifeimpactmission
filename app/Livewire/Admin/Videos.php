<?php

namespace App\Livewire\Admin;

use App\Models\Program;
use App\Models\Video;
use Livewire\Attributes\Title;

#[Title('Videos')]
class Videos extends AdminComponent
{
    public function render()
    {
        return $this->adminView('admin.videos', [
            'data' => Video::with('program')->latest()->get(),
            'programs' => Program::latest()->get(),
        ]);
    }
}