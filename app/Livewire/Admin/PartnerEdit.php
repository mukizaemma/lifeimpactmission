<?php

namespace App\Livewire\Admin;

use App\Models\Partner;
use Livewire\Attributes\Title;

#[Title('Edit Partner')]
class PartnerEdit extends AdminComponent
{
    public $recordId;

    public function mount($id): void
    {
        $this->recordId = $id;
    }

    public function render()
    {
        return $this->adminView('admin.partnerUpdate', [
            'data' => Partner::findOrFail($this->recordId),
        ]);
    }
}