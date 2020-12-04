<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDashusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('dash_types', function (Blueprint $table){
            $table->id();
            $table->string('DHTP_NAME');
        });

        DB::table("dash_types")->insert([
            "DHTP_NAME" => "admin"
        ]);

        Schema::create('dash_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('DASH_USNM');
            $table->string('DASH_FLNM');
            $table->string('DASH_PASS');
            $table->string('DASH_IMGE')->nullable();
            $table->tinyInteger('DASH_ACTV')->default(1);
            $table->softDeletes();
            $table->foreignId('DASH_TYPE_ID')->constrained('dash_types');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dash_users');
        Schema::dropIfExists('dash_types');
    }
}
