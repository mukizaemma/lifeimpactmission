<?php

namespace App\Livewire\Admin;

use App\Models\Campain;
use Livewire\Attributes\Title;

#[Title('Campaigns')]
class Campaigns extends AdminComponent
{
    public function render()
    {
        // Model name may vary; fall back gracefully.
        return $this->adminView('admin.campains', [
            'campain' => Campain::latest()->get(),
            'programs' => \App\Models\Program::all(),
        ]);
    }
}