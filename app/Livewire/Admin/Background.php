<?php

namespace App\Livewire\Admin;

use App\Models\Background as BackgroundModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Project Background')]
class Background extends Component
{
    public function render()
    {
        $data = BackgroundModel::first();
        if ($data === null) {
            $data = new BackgroundModel();
            $data->description = 'Our Background';
            $data->save();
            $data = BackgroundModel::first();
        }

        return view('admin.background', ['data' => $data]);
    }
}