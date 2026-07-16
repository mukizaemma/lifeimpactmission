<?php

namespace App\Livewire\Admin;

use App\Models\PageHeader;
use Livewire\Attributes\Title;

#[Title('Page Headers')]
class PageHeaders extends AdminComponent
{
    public function render()
    {
        return $this->adminView('admin.page-headers', [
            'headers' => PageHeader::orderBy('label')->get(),
        ]);
    }
}