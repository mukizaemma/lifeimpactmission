<?php

namespace App\Livewire\Frontend;

use App\Models\Background;
use App\Models\Program;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Campaign')]
class CampaignShow extends Component
{
    use WithPagination;

    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        return view('frontend.campaign', [
            'about' => Background::first(),
            'testimonials' => DB::table('testimonies')->paginate(6),
            'programs' => Program::oldest()->get(),
        ]);
    }
}