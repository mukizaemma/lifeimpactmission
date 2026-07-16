<?php

namespace App\Livewire\Admin;

use App\Models\Testimony;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Edit Testimony')]
class TestimonyEdit extends Component
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('admin.testimonyUpdate', [
            'data' => Testimony::findOrFail($this->id),
        ]);
    }
}