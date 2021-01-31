<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('downpayments')->insert([
            ['DOWN_VLUE' => "25"]
        ]);

        Schema::table('plans', function (Blueprint $table) {
            $table->tinyInteger('PLAN_ACTV');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn('PLAN_ACTV');
        });

        DB::table('downpayments')->where('DOWN_VLUE' , "25")->delete();
    }
}
