<?php

namespace App\Livewire\Frontend;

use App\Models\Background;
use App\Models\Program;
use App\Models\Team as TeamModel;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Our Team')]
class Team extends Component
{
    public function render()
    {
        return view('frontend.team', [
            'team' => TeamModel::where('category', 'Administration')->oldest()->get(),
            'advisors' => TeamModel::where('category', 'Advisors')->oldest()->get(),
            'programs' => Program::latest()->get(),
            'about' => Background::first(),
        ]);
    }
}