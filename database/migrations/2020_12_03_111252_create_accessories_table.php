<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessories', function (Blueprint $table) {
            $table->id();
            $table->string('ACSR_NAME');
            $table->string('ACSR_ARBC_NAME')->nullable();
        });

        Schema::create('accessories_cars', function (Blueprint $table) {
            $table->id();
            $table->string('ACCR_CAR_ID');
            $table->string('ACCR_ACSR_ID');
            $table->string('ACCR_VLUE')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accessories_cars');
        Schema::dropIfExists('accessories');
    }
}
