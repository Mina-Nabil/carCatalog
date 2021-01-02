<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMaindata2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maindata', function (Blueprint $table){
            $table->text('MAIN_HINT')->nullable(); //extra hint area
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maindata', function (Blueprint $table){
            $table->dropColumn('MAIN_HINT'); 
        });
    }
}
