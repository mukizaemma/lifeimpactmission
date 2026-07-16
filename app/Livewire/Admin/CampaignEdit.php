<?php

namespace App\Livewire\Admin;

use App\Models\Campain;
use App\Models\Program;
use Livewire\Attributes\Title;

#[Title('Edit Campaign')]
class CampaignEdit extends AdminComponent
{
    public $recordId;

    public function mount($id): void
    {
        $this->recordId = $id;
    }

    public function render()
    {
        return $this->adminView('admin.campainUpdate', [
            'campain' => Campain::findOrFail($this->recordId),
            'programs' => Program::all(),
        ]);
    }
}