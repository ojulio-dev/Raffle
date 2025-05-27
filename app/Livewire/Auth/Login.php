<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{

    #[Validate(['required', 'email'])]
    public ?string $email = null;

    #[Validate(['required', 'string'])]
    public ?string $password = null;

    public function handle(): void
    {

        $this->validate();

        if (Auth::attempt([

            'email' => $this->email,
            'password' => $this->password

        ], true)) {

            $this->redirectRoute('home');

        }

        $this->addError('email', 'Invalid credentials.');

    }

    public function render(): View
    {
        return view('livewire.auth.login');
    }
}
