<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInviteUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_invites', function (Blueprint $table) {
            $table->id();
            $table->integer('inviter_id')->index('inviter_id_idx');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('invite_key', 500);
            $table->enum('role', ['MASTER', 'SUPERVISOR', 'MEMBER']);
            $table->enum('status', ['PENDING', 'APPROVED'])->default('PENDING');
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
        Schema::dropIfExists('user_invites');
    }
}
