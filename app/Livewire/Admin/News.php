<?php

namespace App\Livewire\Admin;

use App\Models\News as NewsModel;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Updates')]
class News extends AdminComponent
{
    use WithPagination;

    public function render()
    {
        return $this->adminView('admin.news', [
            'blogs' => NewsModel::latest()->paginate(10),
        ]);
    }
}