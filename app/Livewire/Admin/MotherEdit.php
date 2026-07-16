<?php

namespace App\Livewire\Admin;

use App\Models\Mother;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Edit Mother')]
class MotherEdit extends Component
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('admin.motherUpdate', [
            'data' => Mother::findOrFail($this->id),
        ]);
    }
}