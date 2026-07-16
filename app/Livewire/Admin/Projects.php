<?php

namespace App\Livewire\Admin;

use App\Models\Activity;
use App\Models\Program;
use Livewire\Attributes\Title;

#[Title('Programs')]
class Projects extends AdminComponent
{
    public function render()
    {
        return $this->adminView('admin.activities', [
            'data' => Activity::oldest()->get(),
            'programs' => Program::all(),
        ]);
    }
}