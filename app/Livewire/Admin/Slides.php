<?php

namespace App\Livewire\Admin;

use App\Models\Slide;
use Livewire\Attributes\Title;

#[Title('Slides')]
class Slides extends AdminComponent
{
    public function render()
    {
        return $this->adminView('admin.slides', [
            'slides' => Slide::latest()->get(),
        ]);
    }
}