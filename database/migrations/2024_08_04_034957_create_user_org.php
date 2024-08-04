<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOrg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_orgs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index('user_id_idx');
            $table->string('name');
            $table->timestamps();
        });

        $users = \App\Models\Auth\User::all();

        foreach ($users as $user) {
            \App\Models\UserOrg::create([
                'user_id' => $user->id,
                'name' => $user->first_name . ' ' . $user->last_name
            ]);
        }

        Schema::table('clients', function (Blueprint $table) {
           $table->integer('org_id')->index('org_id_idx')->after('user_id');
        });

        $clients = \App\Models\Client::all();

        foreach ($clients as $client) {
            $userOrg = \App\Models\UserOrg::where('user_id', '=', $client->user_id)->first();

            $client->org_id = $userOrg->id;
            $client->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_orgs');
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['org_id']);
        });
    }
}
