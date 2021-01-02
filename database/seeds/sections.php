<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class sections extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maindata')->delete();
        DB::table('home_sections')->delete();

        DB::table('home_sections')->insert([
            'id'        =>  1,
            'SECT_NAME' => 'Header',
            'SECT_ACTV' =>  1
        ]);

        DB::table('home_sections')->insert([
            'id'        =>  2,
            'SECT_NAME' => 'Landing Image',
            'SECT_ACTV' =>  1
        ]);

        DB::table('home_sections')->insert([
            'id'        =>  3,
            'SECT_NAME' => 'Top Models',
            'SECT_ACTV' =>  1
        ]);

        DB::table('home_sections')->insert([
            'id'        =>  4,
            'SECT_NAME' => 'Top Car Types',
            'SECT_ACTV' =>  1
        ]);

        DB::table('home_sections')->insert([
            'id'        =>  5,
            'SECT_NAME' => 'Logo bar - Partners',
            'SECT_ACTV' =>  1
        ]);

        DB::table('home_sections')->insert([
            'id'        =>  6,
            'SECT_NAME' => 'Showroom stats',
            'SECT_ACTV' =>  1
        ]);

        DB::table('home_sections')->insert([
            'id'        =>  7,
            'SECT_NAME' => 'Offers',
            'SECT_ACTV' =>  1
        ]);
        DB::table('home_sections')->insert([
            'id'        =>  8,
            'SECT_NAME' => 'Trending cars',
            'SECT_ACTV' =>  1
        ]);
        DB::table('home_sections')->insert([
            'id'        =>  9,
            'SECT_NAME' => 'Customers',
            'SECT_ACTV' =>  1
        ]);

    }
}
