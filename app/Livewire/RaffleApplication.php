<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Contracts\View\View;

class RaffleApplication extends Component
{

    public ?string $email = null;

    public bool $success = false;

    public function save(): void
    {

        $this->success = true;

    }

    public function render(): View
    {
        return view('livewire.raffle-application');
    }
}
