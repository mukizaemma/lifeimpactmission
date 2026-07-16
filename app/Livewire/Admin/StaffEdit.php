<?php

namespace App\Livewire\Admin;

use App\Models\Team;
use Livewire\Attributes\Title;

#[Title('Edit Staff')]
class StaffEdit extends AdminComponent
{
    public $recordId;

    public function mount($id): void
    {
        $this->recordId = $id;
    }

    public function render()
    {
        return $this->adminView('admin.teamUpdate', [
            'data' => Team::findOrFail($this->recordId),
        ]);
    }
}