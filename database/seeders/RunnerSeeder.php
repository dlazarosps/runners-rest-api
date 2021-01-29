<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RunnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Runner::factory(10)->create();
    }
}
