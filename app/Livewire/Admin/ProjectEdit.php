<?php

namespace App\Livewire\Admin;

use App\Models\Activity;
use App\Models\Program;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Edit Program')]
class ProjectEdit extends Component
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        $data = Activity::findOrFail($this->id);
        return view('admin.activityUpdate', [
            'data' => $data,
            'programs' => Program::all(),
            'images' => $data->images,
            'totalImages' => $data->images->count(),
        ]);
    }
}