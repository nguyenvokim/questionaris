<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrgToBattery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('batteries', function (Blueprint $table) {
            $table->integer('org_id')->index('org_id_idx');
        });

        $batteries = \App\Models\Battery::all();

        foreach ($batteries as $battery) {
            $userOrg = \App\Models\UserOrg::where('user_id', '=', $battery->user_id)->first();

            $battery->org_id = $userOrg->id;
            $battery->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('batteries', function (Blueprint $table) {
            $table->dropColumn('org_id');
        });
    }
}
