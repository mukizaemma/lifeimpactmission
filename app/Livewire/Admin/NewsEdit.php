<?php

namespace App\Livewire\Admin;

use App\Models\News as NewsModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Edit Update')]
class NewsEdit extends Component
{
    public $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('admin.newsUpdate', [
            'blog' => NewsModel::findOrFail($this->id),
        ]);
    }
}