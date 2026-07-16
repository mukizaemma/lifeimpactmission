<?php

namespace App\Livewire\Admin;

use App\Models\Partner;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Partners')]
class Partners extends Component
{
    public function render()
    {
        return view('admin.partners', [
            'data' => Partner::latest()->get(),
        ]);
    }
}