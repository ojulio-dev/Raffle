<div>
    
    @if ($modal)

    <x-ui.modal title="Deleting Raffle #{{ $id }}">

        <p class="text-red-700 font-bold mb-4 bg-red-200 rounded border-2 border-red-400 p-4">

            Are you sure you want to delete this raffle? This action cannot be undone.

        </p>

        <div class="flex items-center justify-between">

            <x-ui.button secondary wire:click="$set('modal', false)" class="bg-gray-300">

                No... I'm ok!
                
            </x-ui.button>

            <x-ui.button danger wire:click="handle" wire:loading.attr="disabled" wire:target="handle">

                Yes, please!!!

            </x-ui.button>

        </div>

    </x-ui.modal>

    @endif

</div>
