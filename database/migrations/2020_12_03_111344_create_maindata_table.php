<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaindataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->string('SECT_NAME');
            $table->tinyInteger('SECT_ACTV')->default(1);
        });

        Schema::create('maindata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('MAIN_SECT_ID')->constrained('home_sections');
            $table->string("MAIN_ITEM");
            $table->text("MAIN_CNTN")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maindata');
    }
}
