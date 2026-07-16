<?php

namespace App\Livewire\Admin;

use App\Models\About as AboutModel;
use App\Models\Background;
use Livewire\Attributes\Title;

#[Title('Mission & Vision')]
class About extends AdminComponent
{
    public function render()
    {
        $data = AboutModel::first();
        if ($data === null) {
            $data = new AboutModel();
            $data->vision = 'Alleviate poverty among single-teen mothers in Rutsiro District by providing tailoring trainings';
            $data->save();
            $data = AboutModel::first();
        }

        $background = Background::first();
        $ctaImage = $data->backImage ?: ($background->image1 ?? null);

        return $this->adminView('admin.about', [
            'data' => $data,
            'ctaImage' => $ctaImage,
        ]);
    }
}