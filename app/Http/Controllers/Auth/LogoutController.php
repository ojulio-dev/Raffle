<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController
{
    
    public function __invoke(): RedirectResponse
    {

        Auth::logout();

        Session::invalidate();

        Session::regenerateToken();

        return to_route('home');

    }

}
