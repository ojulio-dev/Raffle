<?php

namespace App\Livewire\Raffle;

use Livewire\Component;

use App\Models\Raffle;
use Livewire\Attributes\Computed;

class DrawWinner extends Component
{
    
    public ?Raffle $raffle = null;

    public ?string $winner = null;

    #[Computed]
    public function winners(): int
    {

        return $this->raffle->winners()->count();

    }

    public function handle(): void
    {

        $this->authorize('drawWinner', $this->raffle);

        if ($this->raffle->applicants()->count() < 2) {

            $this->addError('winner', 'At least two participants are required to perform the draw.');

            return;

        }

        $this->rulete();

        $this->getWinner();

    }

    public function rulete(): void
    {

        $applicants = $this->raffle->applicants()
            ->inRandomOrder()
            ->pluck('email');

        foreach($applicants as $email) {

            usleep(80_000);

            $this->stream('winner', $email, true);

        }

    }

    public function getWinner(): void
    {

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

        $this->winner = $winner->email;

        $this->dispatch('winners::refresh')->to('raffle.winners');

        $this->js('confetti.addConfetti()');

    }

    public function render()
    {
        return view('livewire.raffle.draw-winner');
    }
}
