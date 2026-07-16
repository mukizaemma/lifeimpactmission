<?php

namespace App\Livewire\Admin;

use App\Models\Campain;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Campaigns')]
class Campaigns extends Component
{
    public function render()
    {
        // Model name may vary; fall back gracefully.
        return view('admin.campains', [
            'campain' => Campain::latest()->get(),
            'programs' => \App\Models\Program::all(),
        ]);
    }
}