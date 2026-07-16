<?php

namespace App\Livewire\Admin;

use App\Models\Mother;
use Livewire\Attributes\Title;

#[Title('Edit Mother')]
class MotherEdit extends AdminComponent
{
    public $recordId;

    public function mount($id): void
    {
        $this->recordId = $id;
    }

    public function render()
    {
        return $this->adminView('admin.motherUpdate', [
            'data' => Mother::findOrFail($this->recordId),
        ]);
    }
}