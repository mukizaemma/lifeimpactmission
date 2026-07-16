<?php

namespace App\Livewire\Admin;

use App\Models\News as NewsModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.adminbase')]
#[Title('Updates')]
class News extends Component
{
    use WithPagination;

    public function render()
    {
        return view('admin.news', [
            'blogs' => NewsModel::latest()->paginate(10),
        ]);
    }
}