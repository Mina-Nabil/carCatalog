<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("cars", function (Blueprint $table){
            $table->decimal('CAR_HEIT')->nullable()->change();
            $table->decimal('CAR_ACC')->nullable()->change();
            $table->string('CAR_DIMN')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("cars", function (Blueprint $table){
            $table->integer('CAR_HEIT')->nullable()->change();
            $table->integer('CAR_ACC')->nullable()->change();
            $table->dropColumn('CAR_DIMN')();
        });
    }
}
