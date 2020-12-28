<?php

namespace Database\Seeders;

use App\Models\Expanse;
use Illuminate\Database\Seeder;

class ExpanseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expanse::factory()->count(10)->create();
    }
}
