<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Settings')]
class Settings extends Component
{
    public function render()
    {
        return view('admin.settings', [
            'data' => Setting::first(),
        ]);
    }
}