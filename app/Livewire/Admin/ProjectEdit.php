<?php

namespace App\Livewire\Admin;

use App\Models\Activity;
use App\Models\Program;
use Livewire\Attributes\Title;

#[Title('Edit Program')]
class ProjectEdit extends AdminComponent
{
    public $recordId;

    public function mount($id): void
    {
        $this->recordId = $id;
    }

    public function render()
    {
        $data = Activity::findOrFail($this->recordId);
        return $this->adminView('admin.activityUpdate', [
            'data' => $data,
            'programs' => Program::all(),
            'images' => $data->images,
            'totalImages' => $data->images->count(),
        ]);
    }
}