<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login - FR3ON GYM')]
class Login extends Component
{
    public $email;
    public $password;

    public function save()
    {
        $this->validate([
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:6|max:255',
        ]);

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], true)) {
            session()->flash('error', 'Invalid credentials.');
            return;
        }
        // Redirect to intended page or home
        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
