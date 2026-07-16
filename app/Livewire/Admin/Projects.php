<?php

namespace App\Livewire\Admin;

use App\Models\Activity;
use App\Models\Program;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Programs')]
class Projects extends Component
{
    public function render()
    {
        return view('admin.activities', [
            'data' => Activity::oldest()->get(),
            'programs' => Program::all(),
        ]);
    }
}