<?php

namespace App\Livewire\Admin;

use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;

#[Title('Staff')]
class Staff extends AdminComponent
{
    public function render()
    {
        return $this->adminView('admin.team', [
            'team' => DB::table('teams')->latest()->get(),
        ]);
    }
}