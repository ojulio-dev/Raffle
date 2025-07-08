<?php

namespace App\Livewire\Raffle;

use Livewire\Component;

use App\Models\Raffle;
use Livewire\Attributes\Computed;

class DrawWinner extends Component
{
    
    public ?Raffle $raffle = null;

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

        $this->dispatch('winners::refresh')->to('raffle.winners');

    }

    public function render()
    {
        return view('livewire.raffle.draw-winner');
    }
}
