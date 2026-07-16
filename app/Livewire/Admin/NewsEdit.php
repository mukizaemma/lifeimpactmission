<?php

namespace App\Livewire\Admin;

use App\Models\News as NewsModel;
use Livewire\Attributes\Title;

#[Title('Edit Update')]
class NewsEdit extends AdminComponent
{
    public $recordId;

    public function mount($id): void
    {
        $this->recordId = $id;
    }

    public function render()
    {
        return $this->adminView('admin.newsUpdate', [
            'blog' => NewsModel::findOrFail($this->recordId),
        ]);
    }
}