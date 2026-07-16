<?php

namespace App\Livewire\Frontend;

use App\Models\Background;
use App\Models\Program;
use App\Models\Testimony;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Testimony')]
class TestimonyShow extends Component
{
    use WithPagination;

    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        $testimony = Testimony::where('id', $this->id)->firstOrFail();

        view()->share('title', $testimony->names ?? 'Testimony');

        return view('frontend.testimony', [
            'testimony' => $testimony,
            'programs' => Program::latest()->get(),
            'about' => Background::first(),
            'testimonials' => Testimony::where('id', '!=', $testimony->id)->paginate(6),
        ]);
    }
}