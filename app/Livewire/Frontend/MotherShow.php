<?php

namespace App\Livewire\Frontend;

use App\Models\Background;
use App\Models\Mother;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Mother Story')]
class MotherShow extends Component
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $mother = Mother::where('slug', $this->slug)->where('status', 'Active')->firstOrFail();

        return view('frontend.mother', [
            'mother' => $mother,
            'about' => Background::first(),
        ])->title($mother->names . ' | Mother\'s Story');
    }
}