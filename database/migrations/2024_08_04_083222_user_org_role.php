<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserOrgRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_org_roles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index('user_id_idx');
            $table->integer('org_id')->index('org_id_idx');
            $table->enum('role', ['MASTER', 'SUPERVISOR', 'MEMBER']);
            $table->timestamps();
        });

        $userOrgs = \App\Models\UserOrg::all();

        foreach ($userOrgs as $userOrg) {
            \App\Models\UserOrgRole::create([
                'user_id' => $userOrg->user_id,
                'org_id' => $userOrg->id,
                'role' => \App\Models\UserOrgRole::ROLE_MASTER
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_org_roles');
    }
}
