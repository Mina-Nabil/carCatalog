<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('models', function (Blueprint $table){
            $table->string("MODL_PDF")->nullable();
            $table->string("MODL_BGIM")->nullable();
        });

        Schema::create('model_images', function(Blueprint $table){
            $table->id();
            $table->foreignId("MOIM_MODL_ID")->constrained('models');
            $table->string("MOIM_URL");
            $table->integer("MOIM_SORT");
            $table->string("MOIM_COLR");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('models', function (Blueprint $table){
            $table->dropColumn("MODL_PDF");
            $table->dropColumn("MODL_BGIM");
        });

        Schema::dropIfExists("model_images");
    }
}
