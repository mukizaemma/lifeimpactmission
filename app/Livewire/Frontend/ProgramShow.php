<?php

namespace App\Livewire\Frontend;

use App\Models\Activity;
use App\Models\Background;
use App\Models\Gallery;
use App\Models\News;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Program')]
class ProgramShow extends Component
{
    use WithPagination;

    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $activity = Activity::with('images')->where('slug', $this->slug)->firstOrFail();

        return view('frontend.activity', [
            'activity' => $activity,
            'relatedActivities' => Activity::where('id', '!=', $activity->id)->oldest()->get(),
            'about' => Background::first(),
            'gallery' => Gallery::latest()->get(),
            'images' => $activity->images,
            'news' => News::latest()->paginate(9),
        ])->title($activity->title);
    }
}