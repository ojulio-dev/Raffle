<?php

use App\Livewire\Raffle\Create;
use App\Models\Raffle;
use Livewire\Livewire;

it('should create a new raffle', function() {

    Livewire::test(Create::class)
        ->set('name', 'Test Raffle')
        ->call('handle')
        ->assertDispatched('raffle::refresh')
        ->assertSet('name', '');

    $this->assertDatabaseHas('raffles', [

        'name' => 'Test Raffle'

    ]);

});

describe('validations', function() {

    test('name should be required', function() {

        Livewire::test(Create::class)
            ->set('name', '')
            ->call('handle')
            ->assertHasErrors(['name' => 'required']);

    });

    test('name should have at least 5 characters', function() {

        Livewire::test(Create::class)
            ->set('name', 'Test')
            ->call('handle')
            ->assertHasErrors(['name' => 'min']);

    });

    test('name should have a max of 255 caracters', function() {

        Livewire::test(Create::class)
            ->set('name', str_repeat('a', 256))
            ->call('handle')
            ->assertHasErrors(['name' => 'max']);

    });

    test('name should be unique', function() {

        Raffle::create(['name' => 'Unique Raffle']);

        Livewire::test(Create::class)
            ->set('name', 'Unique Raffle')
            ->call('handle')
            ->assertHasErrors(['name' => 'unique']);

    });

});
