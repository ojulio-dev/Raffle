<?php

namespace App\Livewire\Raffle;

use App\Models\Raffle;

use Illuminate\Contracts\View\View as View;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Features\SupportPagination\HandlesPagination;

class Table extends Component
{

    use HandlesPagination;

    #[Computed()]
    public function records(): LengthAwarePaginator
    {

        return Raffle::query()->paginate();

    }


    public function render(): View
    {
        return view('livewire.raffle.table');
    }
}
