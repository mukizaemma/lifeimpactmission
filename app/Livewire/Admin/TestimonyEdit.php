<?php

namespace App\Livewire\Admin;

use App\Models\Testimony;
use Livewire\Attributes\Title;

#[Title('Edit Testimony')]
class TestimonyEdit extends AdminComponent
{
    public $recordId;

    public function mount($id): void
    {
        $this->recordId = $id;
    }

    public function render()
    {
        return $this->adminView('admin.testimonyUpdate', [
            'data' => Testimony::findOrFail($this->recordId),
        ]);
    }
}