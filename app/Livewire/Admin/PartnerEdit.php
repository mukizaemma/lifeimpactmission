<?php

namespace App\Livewire\Admin;

use App\Models\Partner;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Edit Partner')]
class PartnerEdit extends Component
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('admin.partnerUpdate', [
            'data' => Partner::findOrFail($this->id),
        ]);
    }
}