<?php

namespace Database\Seeders;

use App\Models\Raffle;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        Raffle::factory(1)->create();

    }
}
