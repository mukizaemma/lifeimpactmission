<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Attributes\Title;

#[Title('Settings')]
class Settings extends AdminComponent
{
    public function render()
    {
        return $this->adminView('admin.settings', [
            'data' => Setting::first(),
        ]);
    }
}