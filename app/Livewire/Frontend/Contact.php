<?php

namespace App\Livewire\Frontend;

use App\Models\Background;
use App\Models\Message;
use App\Models\Program;
use App\Models\Setting;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Contact')]
class Contact extends Component
{
    public string $names = '';
    public string $email = '';
    public string $message = '';
    public string $successMessage = '';

    public function sendMessage(): void
    {
        $validated = $this->validate([
            'names' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ]);

        Message::firstOrCreate([
            'names' => $validated['names'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        $this->reset(['names', 'email', 'message']);
        $this->successMessage = 'Your Message has been well submitted. We will get back to you soon';
    }

    public function render()
    {
        return view('frontend.contact', [
            'programs' => Program::latest()->get(),
            'contact' => Setting::query()->first(),
            'about' => Background::first(),
        ]);
    }
}