<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class Footer extends Component
{
    public $name;
    public $email;
    public $message;
    public $successMessage;

    public function sendMessage()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        // Send email or store in DB
        Mail::raw("Message from {$this->name} <{$this->email}>:\n\n{$this->message}", function ($mail) {
            $mail->to('fr3ongym2024@gmail.com')
                ->subject('FR3ON GYM Contact Form');
        });

        $this->reset(['name', 'email', 'message']);
        $this->successMessage = __('footer.success_message');
    }

    public function render()
    {
        return view('livewire.partials.footer');
    }
}
