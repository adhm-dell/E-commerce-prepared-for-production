<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Forgot Password - FR3ON GYM')]
class Forgot extends Component
{
    public $email;

    public function save()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email|max:255',
        ]);

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', 'Password reset link sent to your email.');
        }
        $this->email = ''; // Clear the email input after sending the link
    }
    public function render()
    {
        return view('livewire.auth.forgot');
    }
}
