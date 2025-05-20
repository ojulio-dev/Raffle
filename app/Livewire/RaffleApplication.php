<?php

namespace App\Livewire;

use App\Models\Applicant;
use App\Models\Raffle;

use Livewire\Component;

use Illuminate\Contracts\View\View;

class RaffleApplication extends Component
{

    public ?string $email = null;

    public bool $success = false;

    public function save(): void
    {

        Applicant::create([

            'raffle_id' => Raffle::first()->id,

            'email' => $this->email

        ]);

        $this->success = true;

    }

    public function render(): View
    {
        return view('livewire.raffle-application');
    }
}
