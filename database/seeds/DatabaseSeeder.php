<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(sections::class);
        // $this->call(maindata::class);
        $this->call(CalculatorSectionsSeeder::class);

    }
}
