<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitFirst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index('user_id_idx');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('personal_code', 100)->index('personal_code_idx');
            $table->date('birth_date');
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 500);
            $table->text('config');
            $table->text('description');
            $table->timestamps();
        });
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_id')->index('test_id_idx');
            $table->tinyInteger('type');
            $table->string('title', 500);
            $table->text('config');
            $table->timestamps();
        });
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->index('question_id_idx');
            $table->string('title', 500);
            $table->text('config');
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
        Schema::dropIfExists('clients');
        Schema::dropIfExists('tests');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('answers');
    }
}
