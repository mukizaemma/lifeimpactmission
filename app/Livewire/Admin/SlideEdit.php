<?php

namespace App\Livewire\Admin;

use App\Models\Slide;
use Livewire\Attributes\Title;

#[Title('Edit Slide')]
class SlideEdit extends AdminComponent
{
    public $recordId;

    public function mount($id): void
    {
        $this->recordId = $id;
    }

    public function render()
    {
        return $this->adminView('admin.slideUpdate', [
            'data' => Slide::findOrFail($this->recordId),
        ]);
    }
}