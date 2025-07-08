<?php

namespace App\Livewire\Page;

use Livewire\Component;

use App\Models\Raffle as ModelsRaffle;

class Raffle extends Component
{
    public ?ModelsRaffle $raffle = null;

    public function mount(ModelsRaffle $raffle): void
    {

        $this->authorize('onlyPublished', $raffle);

        $this->raffle = $raffle;

    }

    public function render()
    {
        return view('livewire.page.raffle');
    }
}
