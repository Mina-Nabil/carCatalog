<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalculatorSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('home_sections')->insert([
            'id'        =>  10,
            'SECT_NAME' => 'Calculator Page',
            'SECT_ACTV' =>  1
        ]);
        
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  10 ,      //Calculator
            "MAIN_ITEM"     =>  'Calculator Background Image',
            "MAIN_TYPE"     =>  3 ,       // Image
            "MAIN_HINT"     =>  "Calculator section -- section background image"  
        ]);
        
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  10 ,      //Calculator
            "MAIN_ITEM"     =>  'Calculator Car Image',
            "MAIN_TYPE"     =>  3 ,       // Image
            "MAIN_HINT"     =>  "Cut out car image -- preferred size 1243 * 532"  
        ]);
    }
}
