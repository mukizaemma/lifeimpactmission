<?php

namespace App\Livewire\Admin;

use App\Models\Slide;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Edit Slide')]
class SlideEdit extends Component
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('admin.slideUpdate', [
            'data' => Slide::findOrFail($this->id),
        ]);
    }
}