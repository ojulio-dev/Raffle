<?php

namespace App\Livewire\Raffle;

use App\Models\Raffle;

use Illuminate\Contracts\View\View as View;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{

    use WithPagination;

    #[Computed()]
    public function records(): LengthAwarePaginator
    {

        return Raffle::query()->paginate();

    }

    #[On('raffle::refresh')]
    public function render(): View
    {
        return view('livewire.raffle.table');
    }
}
