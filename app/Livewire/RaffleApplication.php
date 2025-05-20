<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Contracts\View\View;

class RaffleApplication extends Component
{

    public ?string $email = null;

    public function render(): View
    {
        return view('livewire.raffle-application');
    }
}
