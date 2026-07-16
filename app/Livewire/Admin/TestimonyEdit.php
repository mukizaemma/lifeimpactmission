<?php

namespace App\Livewire\Admin;

use App\Models\Testimony;
use Livewire\Attributes\Title;

#[Title('Edit Testimony')]
class TestimonyEdit extends AdminComponent
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return $this->adminView('admin.testimonyUpdate', [
            'data' => Testimony::findOrFail($this->id),
        ]);
    }
}