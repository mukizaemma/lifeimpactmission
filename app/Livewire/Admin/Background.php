<?php

namespace App\Livewire\Admin;

use App\Models\Background as BackgroundModel;
use Livewire\Attributes\Title;

#[Title('Project Background')]
class Background extends AdminComponent
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

        return $this->adminView('admin.background', ['data' => $data]);
    }
}