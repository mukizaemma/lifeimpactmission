<?php

namespace App\Livewire\Frontend;

use App\Models\About as AboutModel;
use App\Models\Background;
use App\Models\Impact;
use App\Models\Partner;
use App\Models\Program;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Who We Are')]
class About extends Component
{
    use WithPagination;

    public function render()
    {
        $impacts = Impact::where('status', 'Active')->latest()->get();
        if ($impacts->isEmpty()) {
            $impacts = Impact::latest()->take(4)->get();
        }

        return view('frontend.about', [
            'about' => Background::first(),
            'mission' => AboutModel::first(),
            'testimonials' => DB::table('testimonies')->paginate(3),
            'programs' => Program::latest()->get(),
            'partners' => Partner::oldest()->get(),
            'staff' => Team::oldest()->get(),
            'impacts' => $impacts,
        ]);
    }
}