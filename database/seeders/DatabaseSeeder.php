<?php

namespace Database\Seeders;

use App\Models\Raffle;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        Raffle::factory(2)->create();

        User::factory()->create(['email' => 'joe@doe.com']);

    }
}
