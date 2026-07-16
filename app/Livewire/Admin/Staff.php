<?php

namespace App\Livewire\Admin;

use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Staff')]
class Staff extends Component
{
    public function render()
    {
        return view('admin.team', [
            'team' => DB::table('teams')->latest()->get(),
        ]);
    }
}