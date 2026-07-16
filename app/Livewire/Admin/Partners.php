<?php

namespace App\Livewire\Admin;

use App\Models\Partner;
use Livewire\Attributes\Title;

#[Title('Partners')]
class Partners extends AdminComponent
{
    public function render()
    {
        return $this->adminView('admin.partners', [
            'data' => Partner::latest()->get(),
        ]);
    }
}