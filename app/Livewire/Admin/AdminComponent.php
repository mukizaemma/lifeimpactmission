<?php

namespace App\Livewire\Admin;

use Illuminate\Auth\AuthenticationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.adminbase')]
abstract class AdminComponent extends Component
{
    public function boot(): void
    {
        if (! auth()->check()) {
            throw new AuthenticationException('Unauthenticated.', ['web'], route('login'));
        }
    }

    /**
     * Always pin admin pages to the admin chrome (never the public frontbase default).
     */
    protected function adminView(string $view, array $data = [])
    {
        return view($view, $data)->layout('layouts.adminbase');
    }
}
