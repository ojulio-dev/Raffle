<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Contracts\View\View;

class RaffleApplication extends Component
{
    public function render(): View
    {
        return view('livewire.raffle-application');
    }
}
