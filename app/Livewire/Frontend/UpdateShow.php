<?php

namespace App\Livewire\Frontend;

use App\Models\Background;
use App\Models\News;
use App\Models\Program;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Update')]
class UpdateShow extends Component
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $blog = News::where('slug', $this->slug)->firstOrFail();

        return view('frontend.blog', [
            'blog' => $blog,
            'images' => $blog->Blogimages()->latest()->get(),
            'relatedBlogs' => News::where('id', '!=', $blog->id)->latest()->take(6)->get(),
            'programs' => Program::latest()->get(),
            'about' => Background::first(),
        ])->title($blog->title);
    }
}