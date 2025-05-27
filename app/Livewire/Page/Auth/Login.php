<?php

namespace App\Livewire\Page\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
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

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], true)) {

            throw ValidationException::withMessages([

                'email' => __('auth.failed'),

            ]);

        }

        RateLimiter::clear($this->rateKey());

        Session::regenerate();

        $this->redirectRoute('home');

    }

    private function ensureIsNotRateLimited(): void
    {

        if (RateLimiter::tooManyAttempts($this->rateKey(), 5)) {

            $seconds = RateLimiter::availableIn($this->rateKey());

            throw ValidationException::withMessages([

                'email' => 'Too many login attempts. Please try again in ' . $seconds . ' seconds.',

            ]);

        }

        RateLimiter::hit($this->rateKey());

    }

    private function rateKey(): string
    {

        return str($this->email . '|' . request()->ip())
                ->replace('@', '_at_')
                ->replace('.', '_')
                ->slug();

    }

    public function render(): View
    {
        return view('livewire.auth.login');
    }
}
