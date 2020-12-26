<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMaindataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maindata', function (Blueprint $table){
            $table->tinyInteger('MAIN_TYPE')->default(1); //1 text //2 textArea //3 Image
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
            $table->dropColumn('MAIN_TYPE');
        });
    }
}
