<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLoansTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downpayments', function (Blueprint $table) {
            $table->id();
            $table->decimal("DOWN_VLUE")->unique();
        });

        DB::table('downpayments')->insert([
            ['DOWN_VLUE' => "20"], ['DOWN_VLUE' => "30"], ['DOWN_VLUE' => "40"], ['DOWN_VLUE' => "50"], ['DOWN_VLUE' => "60"], ['DOWN_VLUE' => "70"],
        ]);

        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string("BANK_NAME")->unique();
            $table->decimal("BANK_EXPN");
        });

        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->string("INSR_NAME")->unique();
            $table->decimal("INSR_VLUE");
        });

        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId("PLAN_DOWN_ID")->constrained("downpayments");
            $table->foreignId("PLAN_BANK_ID")->constrained("banks");
            $table->string("PLAN_YEAR");
            $table->decimal("PLAN_INTR");
            $table->tinyInteger('PLAN_INSR');
            $table->tinyInteger('PLAN_EMPL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
        Schema::dropIfExists('insurances');
        Schema::dropIfExists('banks');
        Schema::dropIfExists('downpayments');
    }
}
