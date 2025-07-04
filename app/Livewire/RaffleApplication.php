<?php

namespace App\Livewire;

use App\Models\Applicant;
use App\Models\Raffle;

use Livewire\Component;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;

class RaffleApplication extends Component
{

    public ?Raffle $raffle = null;

    public ?string $email = null;

    public bool $success = false;

    public function mount(Raffle $raffle): void
    {

        $this->authorize('onlyPublished', $raffle);

        $this->raffle = $raffle;

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

    #[Computed]
    public function winners(): int
    {

        return $this->raffle->winners()->count();

    }

    public function getWinner(): void
    {

        $this->authorize('drawWinner', $this->raffle);

        if ($this->raffle->applicants()->count() < 2) {

            $this->addError('winner', 'At least two participants are required to perform the draw.');

            return;

        }

        $winners = $this->raffle->winners->pluck('applicant_id')->toArray();

        $winner = $this->raffle->applicants()
            ->whereNotIn('id', $winners)
            ->inRandomOrder()
            ->first();

        if (!$winner) {

            $this->addError('winner', 'No more participants available for the draw.');

            return;

        }

        $this->raffle->winners()->create([

            'applicant_id' => $winner->id

        ]);

    }

    public function save(): void
    {

        $this->validate();

        $this->raffle->applicants()->create([

            'email' => $this->email

        ]);

        $this->success = true;

    }

    #[Computed]
    public function participants(): Collection
    {

        return $this->raffle->applicants()->get()->map(

            fn($applicant) =>

            preg_replace("/(?<=.{2}).(?=.*@)/u", '*', $applicant->email)

        );

    }

    public function render(): View
    {
        return view('livewire.raffle-application');
    }
}
