<?php

namespace App\Livewire\Raffle;

use App\Models\Raffle;
use Illuminate\Contracts\View\View;

use Livewire\Attributes\On;
use Livewire\Component;

class Unpublish extends Component
{

    public bool $modal = false;

    public ?Raffle $raffle = null;

    #[On('raffle::unpublish')]
    public function open(int $id): void
    {

        $this->modal = true;

        $this->raffle = Raffle::findOrFail($id);

    }

    public function handle(): void
    {

       $this->raffle->update(['published_at' => null]);

        $this->dispatch('raffle::refresh');

        $this->reset();

    }

    public function render(): View
    {
        return view('livewire.raffle.unpublish');
    }
}
