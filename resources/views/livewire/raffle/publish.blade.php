<div>
    
    @if ($modal)

    <x-ui.modal title="Deleting Raffle #{{ $raffle->id }}">

        <p class="text-blue-700 font-bold mb-4 bg-blue-200 rounded border-2 border-blue-400 p-4">

            Are you sure you want to publish this raffle?

        </p>

        <div class="flex items-center justify-between">

            <x-ui.button secondary wire:click="$set('modal', false)">

                No... I'm ok!
                
            </x-ui.button>

            <x-ui.button wire:click="handle" wire:loading.attr="disabled" wire:target="handle">

                Yes, please!!!

            </x-ui.button>

        </div>

    </x-ui.modal>

    @endif

</div>
