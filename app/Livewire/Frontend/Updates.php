<?php

namespace App\Livewire\Frontend;

use App\Models\Background;
use App\Models\News;
use App\Models\Program;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Updates')]
class Updates extends Component
{
    use WithPagination;

    public function render()
    {
        return view('frontend.blogs', [
            'news' => News::latest()->paginate(20),
            'programs' => Program::latest()->get(),
            'about' => Background::first(),
        ]);
    }
}