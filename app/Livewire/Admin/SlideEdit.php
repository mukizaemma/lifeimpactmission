<?php

namespace App\Livewire\Admin;

use App\Models\Slide;
use Livewire\Attributes\Title;

#[Title('Edit Slide')]
class SlideEdit extends AdminComponent
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return $this->adminView('admin.slideUpdate', [
            'data' => Slide::findOrFail($this->id),
        ]);
    }
}