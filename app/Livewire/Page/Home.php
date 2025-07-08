<?php

namespace App\Livewire\Page;

use App\Models\Raffle;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

use Livewire\Attributes\Computed;
use Livewire\Component;

class Home extends Component
{

    #[Computed]
    public function raffles(): Collection
    {

        return Raffle::query()
            ->withCount('applicants', 'winners')
            ->whereNotNull('published_at')
            ->get();

    }

    public function render(): View
    {
        return view('livewire.home');
    }
}
