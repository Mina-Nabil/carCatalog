<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->string('MODL_NAME');
            $table->string('MODL_YEAR');
            $table->foreignId("MODL_BRND_ID")->constrained("brands");
            $table->string('MODL_ARBC_NAME')->nullable();
            $table->text('MODL_OVRV')->nullable();
            $table->tinyInteger('MODL_MAIN')->default(0);
            $table->tinyInteger('MODL_ACTV')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('models');
    }
}
