<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class maindata extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //type 1 text 2 paragraph 3 image 4 readmore button

        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  1 ,      //landing image
            "MAIN_ITEM"     =>  'Logo',
            "MAIN_TYPE"     =>  3 ,       // image  
            "MAIN_HINT"     =>  "Logo size should be 153*43"  
        ]);

        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Title 1',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Title Shown in home page on the first slide"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Subtitle 1',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Subtitle Text Shown in home page on the first slide under the title"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Image 1',
            "MAIN_TYPE"     =>  3 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Backgroung Image Shown in home page for the first slide -- 1920*830"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Button 1',
            "MAIN_TYPE"     =>  4 ,       // string (text)  
            "MAIN_HINT"     =>  "First read more button -- enter url redirect url"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Title 2',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Title Shown in home page on the second slide"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Subtitle 2',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Subtitle Text Shown in home page on the second slide under the title"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Image 2',
            "MAIN_TYPE"     =>  3 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Backgroung Image Shown in home page for the second slide -- 1920*830"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Button 2',
            "MAIN_TYPE"     =>  4 ,       // string (text)  
            "MAIN_HINT"     =>  "First read more button -- enter url redirect url"  
        ]);

        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Title 3',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Title Shown in home page on the third slide"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Subtitle 3',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Subtitle Text Shown in home page on the third slide under the title"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Image 3',
            "MAIN_TYPE"     =>  3 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Backgroung Image Shown in home page for the third slide -- 1920*830"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Button 3',
            "MAIN_TYPE"     =>  4 ,       // button  
            "MAIN_HINT"     =>  "First read more button -- enter url redirect url"  
        ]);

        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Title 4',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Title Shown in home page on the fourth slide"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Subtitle 4',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Subtitle Text Shown in home page on the fourth slide under the title"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Image 4',
            "MAIN_TYPE"     =>  3 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Backgroung Image Shown in home page for the fourth slide -- 1920*830"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Button 4',
            "MAIN_TYPE"     =>  4 ,       // string (text)  
            "MAIN_HINT"     =>  "First read more button -- enter url redirect url"  
        ]);

        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Title 5',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Title Shown in home page on the fifth slide"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Subtitle 5',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Subtitle Text Shown in home page on the fifth slide under the title"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Image 5',
            "MAIN_TYPE"     =>  3 ,       // string (text)  
            "MAIN_HINT"     =>  "Header Backgroung Image Shown in home page for the fifth slide -- 1920*830"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  2 ,      //landing image
            "MAIN_ITEM"     =>  'Slide Button 5',
            "MAIN_TYPE"     =>  4 ,       // string (text)  
            "MAIN_HINT"     =>  "First read more button -- enter url redirect url"  
        ]);


        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  3 ,      //Top Models
            "MAIN_ITEM"     =>  'Top Models Section Title',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Top Models Section Header"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  3 ,      //Top Models
            "MAIN_ITEM"     =>  'Top Models Section Text',
            "MAIN_TYPE"     =>  2 ,       // string (text)  
            "MAIN_HINT"     =>  "Top Models Section Text -- appears under the title"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  4 ,      //Top Car types
            "MAIN_ITEM"     =>  'Top Cars Section Title',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Top Car Types Section Title"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  4 ,      //Top Car types
            "MAIN_ITEM"     =>  'Top Cars Section Text',
            "MAIN_TYPE"     =>  2 ,       // string (text)  
            "MAIN_HINT"     =>  "Top Car Types Section Text -- appears under the title "  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  6 ,      //Show room stats
            "MAIN_ITEM"     =>  'Years In Business - Stats',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Showroom stats section"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  6 ,      //Show room stats
            "MAIN_ITEM"     =>  'New Cars for Sale - Stats',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Showroom stats section"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  6 ,      //Show room stats
            "MAIN_ITEM"     =>  'Number of Sold Cars - Stats',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Showroom stats section"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  6 ,      //Show room stats
            "MAIN_ITEM"     =>  'Number of clients - Stats',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Showroom stats section"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  7 ,      //Offers
            "MAIN_ITEM"     =>  'Offers Section Title',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Offers section -- section title"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  7 ,      //Offers
            "MAIN_ITEM"     =>  'Offer Section Subtitle',
            "MAIN_TYPE"     =>  2 ,       // string (text)  
            "MAIN_HINT"     =>  "Offers section -- section subtitle appears under the title"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  8 ,      //Trending
            "MAIN_ITEM"     =>  'Trending Section Title',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Trending section -- section title"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  8 ,      //Trending
            "MAIN_ITEM"     =>  'Trending Section Subtitle',
            "MAIN_TYPE"     =>  2 ,       // string (text)  
            "MAIN_HINT"     =>  "Trending section -- section subtitle appears under the title"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  9 ,      //Customers
            "MAIN_ITEM"     =>  'Customers Section Title',
            "MAIN_TYPE"     =>  1 ,       // string (text)  
            "MAIN_HINT"     =>  "Customers section -- section title"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  9 ,      //Customers
            "MAIN_ITEM"     =>  'Customers Section Subtitle',
            "MAIN_TYPE"     =>  2 ,       // string (text)  
            "MAIN_HINT"     =>  "Customers section -- section subtitle appears under the header"  
        ]);
        DB::table('maindata')->insert([
            'MAIN_SECT_ID'  =>  9 ,      //Customers
            "MAIN_ITEM"     =>  'Customers Section Background Image',
            "MAIN_TYPE"     =>  3 ,       // Image
            "MAIN_HINT"     =>  "Customers section -- section background image"  
        ]);
    }
}
