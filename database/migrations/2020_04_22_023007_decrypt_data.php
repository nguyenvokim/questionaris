<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DecryptData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('email', 5000)->change();
            $table->string('personal_code', 5000)->change();
        });
        $clients = DB::table('clients')
            ->get();
        $clients->each(function ($item, $key) {
            DB::table('clients')
                ->where('id', '=', $item->id)
                ->update([
                    'email' => Crypt::encryptString($item->email),
                    'personal_code' => Crypt::encryptString($item->personal_code),
                ]);
        });

        $clientTestResult = DB::table('client_test_results')
            ->get();
        $clientTestResult->each(function ($item, $key) {
            DB::table('client_test_results')
                ->where('id', '=', $item->id)
                ->update([
                    'config' => Crypt::encryptString($item->config),
                ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $clients = DB::table('clients')
            ->get();
        $clients->each(function ($item, $key) {
            DB::table('clients')
                ->where('id', '=', $item->id)
                ->update([
                    'email' => Crypt::decryptString($item->email),
                    'personal_code' => Crypt::decryptString($item->personal_code),
                ]);
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->string('email', 255)->change();
            $table->string('personal_code', 255)->change();
        });

        $clientTestResult = DB::table('client_test_results')
            ->get();
        $clientTestResult->each(function ($item, $key) {
            DB::table('client_test_results')
                ->where('id', '=', $item->id)
                ->update([
                    'config' => Crypt::decryptString($item->config),
                ]);
        });
    }
}
