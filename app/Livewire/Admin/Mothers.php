<?php

namespace App\Livewire\Admin;

use App\Models\Mother;
use Livewire\Attributes\Title;

#[Title('Mothers')]
class Mothers extends AdminComponent
{
    public function render()
    {
        return $this->adminView('admin.mothers', [
            'data' => Mother::oldest()->get(),
        ]);
    }
}