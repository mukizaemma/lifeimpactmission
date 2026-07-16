<?php

namespace App\Livewire\Admin;

use App\Models\PageHeader;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.adminbase')]
#[Title('Page Headers')]
class PageHeaders extends Component
{
    public function render()
    {
        return view('admin.page-headers', [
            'headers' => PageHeader::orderBy('label')->get(),
        ]);
    }
}