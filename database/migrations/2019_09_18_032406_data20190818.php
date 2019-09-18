<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Data20190818 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_batteries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->index('client_id_idx');
            $table->integer('battery_id')->index('battery_id_idx');
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('status')->index('status_idx');
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
        Schema::dropIfExists('client_batteries');
    }
}
