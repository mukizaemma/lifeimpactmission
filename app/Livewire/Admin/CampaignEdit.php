<?php

namespace App\Livewire\Admin;

use App\Models\Campain;
use App\Models\Program;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Edit Campaign')]
class CampaignEdit extends Component
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('admin.campainUpdate', [
            'campain' => Campain::findOrFail($this->id),
            'programs' => Program::all(),
        ]);
    }
}