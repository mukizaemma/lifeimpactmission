<?php

namespace App\Livewire\Admin;

use App\Models\Testimony;
use Livewire\Attributes\Title;

#[Title('Testimonials')]
class Testimonials extends AdminComponent
{
    public function render()
    {
        return $this->adminView('admin.testimonies', [
            'data' => Testimony::latest()->get(),
        ]);
    }
}