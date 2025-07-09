<?php

namespace App\Livewire\Raffle;

use App\Models\Raffle;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('winners::refresh')]
class Winners extends Component
{
    public Raffle $raffle;

    public bool $show = false;

    public function toggleShow():void
    {

        $this->show = !$this->show;

    }

    #[Computed]
    public function winners(): Collection|SupportCollection
    {

        return $this->raffle->winners()
            ->with('applicant')
            ->latest()
            ->get()
            ->map(fn($winner) => 

                $this->show
                ? $winner->applicant->email
                : preg_replace("/(?<=.{2}).(?=.*@)/u", '*', $winner->applicant->email)

            );

    }

    public function render(): View
    {
        return view('livewire.raffle.winners');
    }
}
