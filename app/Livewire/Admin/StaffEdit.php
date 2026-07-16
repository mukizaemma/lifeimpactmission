<?php

namespace App\Livewire\Admin;

use App\Models\Team;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Edit Staff')]
class StaffEdit extends Component
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('admin.teamUpdate', [
            'data' => Team::findOrFail($this->id),
        ]);
    }
}