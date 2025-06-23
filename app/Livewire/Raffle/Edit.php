<?php

namespace App\Livewire\Raffle;

use App\Models\Raffle;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{

    public bool $modal = false;

    public ?Raffle $raffle = null;

    public function rules(): array
    {

        return [

            'raffle.name' => ['required', 'string', 'min:5', 'max:255', 'unique:raffles,name' . $this->raffle->id]

        ];

    }

    #[On('raffle::edit')]
    public function open(int $id): void
    {

        $this->modal = true;

        $this->raffle = Raffle::findOrFail($id);

    }

    public function handle(): void
    {

        $this->validate();

        $this->raffle->save();

        $this->dispatch('raffle::refresh');

        $this->reset();

    }

    public function render(): View
    {
        return view('livewire.raffle.edit');
    }
}
