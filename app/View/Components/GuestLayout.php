<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\View\Component;

class GuestLayout extends Component
{
    public ?string $brandText;

    public ?string $pageTitle;

    public function __construct(?string $brandText = null, ?string $pageTitle = null)
    {
        $this->brandText = $brandText;
        $this->pageTitle = $pageTitle;
    }

    public function render()
    {
        return view('layouts.auth', [
            'setting' => Setting::first(),
            'brandText' => $this->brandText,
            'pageTitle' => $this->pageTitle,
        ]);
    }
}
