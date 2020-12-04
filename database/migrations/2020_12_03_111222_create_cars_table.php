<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('CAR_MODL_ID')->constrained('models');
            $table->string('CAR_CATG');
            $table->integer('CAR_PRCE');
            $table->foreignId('CAR_TYPE_ID')->constrained('types');
            $table->integer('CAR_DISC')->default(0);

            $table->integer('CAR_VLUE')->default(500);  //the higher the better

            $table->tinyInteger('CAR_ACTV')->default(0);

            //Car specs -- all nullable as they can add car before publish
            $table->integer('CAR_HPWR')->nullable();
            $table->integer('CAR_SEAT')->nullable();
            $table->integer('CAR_ENCC')->nullable();
            $table->integer('CAR_ENTQ')->nullable();
            $table->integer('CAR_TRNS')->nullable();
            $table->integer('CAR_TPSP')->nullable();
            $table->integer('CAR_HEIT')->nullable();

            //Car marketing info
            $table->string('CAR_TTL1')->nullable();
            $table->text('CAR_PRG1')->nullable();
            $table->string('CAR_TTL2')->nullable();
            $table->text('CAR_PRG2')->nullable();

            //Car Offer
            $table->dateTime('CAR_OFFR')->nullable(); //is offer on car
            $table->dateTime('CAR_TRND')->nullable(); //is offer on car

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
