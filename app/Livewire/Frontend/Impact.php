<?php

namespace App\Livewire\Frontend;

use App\Models\Gallery;
use App\Models\Image;
use App\Models\Impact as ImpactModel;
use App\Models\Partner;
use App\Services\InstagramService;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Our Impact')]
class Impact extends Component
{
    public function render(InstagramService $instagramService)
    {
        $impacts = ImpactModel::where('status', 'Active')->latest()->get();
        if ($impacts->isEmpty()) {
            $impacts = ImpactModel::latest()->get();
        }

        $gallery = Image::latest()->take(9)->get();
        if ($gallery->isEmpty()) {
            $gallery = Gallery::latest()->take(9)->get();
        }

        return view('frontend.impact', [
            'impacts' => $impacts,
            'gallery' => $gallery,
            'partners' => Partner::oldest()->get(),
            'instagramPost' => $instagramService->getLatestPost(),
        ]);
    }
}
