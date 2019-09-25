<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Data20190910 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_email_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->index('client_id_idx');
            $table->tinyInteger('type')->index('type_idx');
            $table->integer('relate_object_id');
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
        Schema::dropIfExists('client_email_logs');
    }
}
