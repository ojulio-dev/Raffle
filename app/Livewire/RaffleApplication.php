<?php

namespace App\Livewire;

use App\Models\Applicant;
use App\Models\Raffle;

use Livewire\Component;

use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

class RaffleApplication extends Component
{

    public ?Raffle $raffle = null;

    public ?string $email = null;

    public bool $success = false;

    public function mount(): void
    {

        $this->raffle = Raffle::InRandomOrder()->first();

    }

    public function rules(): array
    {

        return [

            'email' => [

                'required',

                'email',

                Rule::unique('applicants', 'email')->where('raffle_id', $this->raffle->id)

            ]

        ];

    }

    public function save(): void
    {

        $this->validate();

        Applicant::create([

            'raffle_id' => $this->raffle->id,

            'email' => $this->email

        ]);

        $this->success = true;

    }

    public function render(): View
    {
        return view('livewire.raffle-application');
    }
}
