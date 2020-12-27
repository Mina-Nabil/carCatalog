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
        // $this->call(UserSeeder::class);


        DB::table('dash_users')->insert([
            "DASH_USNM" => "mina",
            "DASH_FLNM" => "Mina Nabil",
            "DASH_PASS" => bcrypt('mina@catalog'),
            "DASH_TYPE_ID" => 1,
        ]);


        DB::table('home_sections')->insert([
            'id'        =>  1,
            'SECT_NAME' => 'Header',
            'SECT_ACTV' =>  0
        ]);

        DB::table('home_sections')->insert([
            'id'        =>  2,
            'SECT_NAME' => 'Landing Image',
            'SECT_ACTV' =>  0
        ]);

        DB::table('home_sections')->insert([
            'id'        =>  3,
            'SECT_NAME' => 'Top Models',
            'SECT_ACTV' =>  0
        ]);

        DB::table('home_sections')->insert([
            'id'        =>  4,
            'SECT_NAME' => 'Top Car Types',
            'SECT_ACTV' =>  0
        ]);

        DB::table('home_sections')->insert([
            'id'        =>  5,
            'SECT_NAME' => 'Logo bar - Partners',
            'SECT_ACTV' =>  0
        ]);

        DB::table('home_sections')->insert([
            'id'        =>  6,
            'SECT_NAME' => 'Showroom stats',
            'SECT_ACTV' =>  0
        ]);

        DB::table('home_sections')->insert([
            'id'        =>  7,
            'SECT_NAME' => 'Offers',
            'SECT_ACTV' =>  0
        ]);
        DB::table('home_sections')->insert([
            'id'        =>  8,
            'SECT_NAME' => 'Trending cars',
            'SECT_ACTV' =>  0
        ]);
        DB::table('home_sections')->insert([
            'id'        =>  9,
            'SECT_NAME' => 'Customers',
            'SECT_ACTV' =>  0
        ]);

        ///////////////

        DB::table('maindata')->insert([

        ]);
    }
}
