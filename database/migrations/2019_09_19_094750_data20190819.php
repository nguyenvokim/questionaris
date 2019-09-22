<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Data20190819 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_test_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->index('client_id_idx');
            $table->integer('test_id')->index('test_id_idx');
            $table->string('title', 500);
            $table->text('config');
            $table->text('description');
            $table->timestamps();
        });
        Schema::create('client_test_result_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_result_id')->index('test_result_id_idx');
            $table->integer('question_id')->index('question_id_idx');
            $table->string('title', 500);
            $table->text('config');
            $table->tinyInteger('type');
            $table->tinyInteger('score');
            $table->timestamps();
        });
        Schema::create('client_test_result_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_result_question_id')->index('test_result_question_id_idx');
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
        Schema::dropIfExists('client_test_results');
        Schema::dropIfExists('client_test_result_questions');
        Schema::dropIfExists('client_test_result_answers');
    }
}
