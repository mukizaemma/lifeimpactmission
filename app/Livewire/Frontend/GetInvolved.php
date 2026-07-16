<?php

namespace App\Livewire\Frontend;

use App\Models\Background;
use App\Models\Message;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Get Involved')]
class GetInvolved extends Component
{
    public string $names = '';
    public string $email = '';
    public string $message = '';
    public string $successMessage = '';

    public function submitVolunteer(): void
    {
        $validated = $this->validate([
            'names' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ]);

        $body = str_starts_with($validated['message'], '[Volunteer]')
            ? $validated['message']
            : '[Volunteer] ' . $validated['message'];

        Message::firstOrCreate([
            'names' => $validated['names'],
            'email' => $validated['email'],
            'message' => $body,
        ]);

        $this->reset(['names', 'email', 'message']);
        $this->successMessage = 'Thanks for offering to volunteer. We will get back to you soon.';
    }

    public function render()
    {
        return view('frontend.get-involved', [
            'about' => Background::first(),
        ]);
    }
}