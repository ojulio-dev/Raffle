<div>
    
    @can('drawWinner', $raffle)
        
        <x-ui.error name="winner" />

        <x-ui.button  type="button" wire:click="getWinner" class="mt-4">Draw the winner</x-ui.button>

    @endcan

</div>
