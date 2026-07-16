<?php

namespace App\Livewire\Frontend;

use App\Models\About;
use App\Models\Activity;
use App\Models\Background;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Impact;
use App\Models\Mother;
use App\Models\Partner;
use App\Models\Slide;
use App\Models\Team;
use App\Models\Testimony;
use App\Services\InstagramService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
class Home extends Component
{
    public function render(InstagramService $instagramService)
    {
        $today = Carbon::today()->toDateString();
        $upcomingEvents = Event::where('status', 'Active')
            ->where('date', '>=', $today)
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->orderBy('date', 'asc')
            ->get();

        $featuredEvent = $upcomingEvents->first();
        $eventIsUpcoming = (bool) $featuredEvent;

        if (! $featuredEvent) {
            $featuredEvent = Event::where('status', 'Active')
                ->whereNotNull('image')
                ->where('image', '!=', '')
                ->orderByRaw('CASE WHEN date IS NULL OR date = "" THEN 1 ELSE 0 END')
                ->orderByDesc('date')
                ->orderByDesc('created_at')
                ->first();
        }

        $impacts = Impact::where('status', 'Active')->latest()->get();
        if ($impacts->isEmpty()) {
            $impacts = Impact::latest()->take(4)->get();
        }

        $mothers = collect();
        try {
            if (Schema::hasTable('mothers')) {
                $mothers = Mother::where('status', 'Active')->oldest()->take(4)->get();
            }
        } catch (\Throwable $e) {
            $mothers = collect();
        }

        return view('frontend.home', [
            'background' => Background::latest()->get(),
            'programs' => Activity::oldest()->get(),
            'homeGallery' => Gallery::latest()->get(),
            'featuredEvent' => $featuredEvent,
            'eventIsUpcoming' => $eventIsUpcoming,
            'upcomingEvents' => $upcomingEvents,
            'slides' => Slide::oldest()->get(),
            'testimonials' => Testimony::latest()->take(3)->get(),
            'partners' => Partner::oldest()->get(),
            'impacts' => $impacts,
            'instagramPost' => $instagramService->getLatestPost(),
            'staff' => Team::latest()->get(),
            'about' => Background::first(),
            'mission' => About::first(),
            'mothers' => $mothers,
        ]);
    }
}