<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Page;

use App\Http\Controllers\Auth;

Route::get('/login', Page\Auth\Login::class)->middleware('guest')->name('login');

Route::middleware('auth')->group(function() {

    Route::get('/logout', Auth\LogoutController::class)->name('logout');

    Route::get('/admin/raffle', Page\Admin\Raffle::class)
        ->middleware('can:admin')
        ->name('admin.raffle');

});

Route::get('/', Page\Home::class)->name('home');
Route::get('/{raffle}', Page\Raffle::class)->name('raffle');
