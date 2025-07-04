<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Register - FR3ON GYM')]
class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $confirmPassword;

    //register user
    public function save()
    {
        // dd($this->name, $this->email, $this->password, $this->confirmPassword);
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:255',
            'confirmPassword' => 'required|same:password',
        ]);

        // Create the user
        // if ($this->password != $this->confirmPassword) {
        //     LivewireAlert::title('Passwords do not match!')
        //         ->error()
        //         ->position('bottom-end')
        //         ->toast(true)
        //         ->show();
        //     return;
        // }
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        \Illuminate\Support\Facades\Auth::login($user);

        return redirect()->intended();
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
