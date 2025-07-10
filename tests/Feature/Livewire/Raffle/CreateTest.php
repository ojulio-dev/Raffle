<?php

use App\Livewire\Raffle\Create;
use Livewire\Livewire;

it('should create a new raffle', function() {

    Livewire::test(Create::class)
        ->set('name', 'Test Raffle')
        ->call('handle');

    $this->assertDatabaseHas('raffles', [

        'name' => 'Test Raffle'

    ]);

});
