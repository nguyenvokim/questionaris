<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Init2019917 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batteries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index('user_id_idx');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('battery_test', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_id')->index('test_id_idx');
            $table->integer('battery_id')->index('battery_id_idx');
            $table->integer('order');
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
        Schema::dropIfExists('batteries');
        Schema::dropIfExists('battery_test');
    }
}
