<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToUserOrg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_orgs', function (Blueprint $table) {
            $table->enum('status', ['ACTIVE', 'DE_ACTIVE'])->index('status_idx')->default('ACTIVE')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_orgs', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
    }
}
