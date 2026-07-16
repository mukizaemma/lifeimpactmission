<?php

namespace App\Livewire\Admin;

use App\Models\Mother;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Mothers')]
class Mothers extends Component
{
    public function render()
    {
        return view('admin.mothers', [
            'data' => Mother::oldest()->get(),
        ]);
    }
}