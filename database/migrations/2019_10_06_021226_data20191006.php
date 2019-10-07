<?php

use App\Models\BatteryTest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Data20191006 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $test = \App\Models\Test::find(1);
        $test->title = 'DASS-21';
        $test->save();
        Schema::table('clients', function (Blueprint $table) {
            $table->tinyInteger('gender')->default(0)->after('birth_date');
        });

        Schema::table('batteries', function (Blueprint $table) {
            $table->tinyInteger('is_default')->default(0)->after('name');
        });
        $tests = \App\Models\Test::all();
        $users = \App\Models\Auth\User::all();
        foreach ($users as $user) {
            foreach ($tests as $test) {
                $battery = \App\Models\Battery::create([
                    'user_id' => $user->id,
                    'name' => $test->title,
                    'is_default' => \App\Models\Battery::BATTERY_DEFAULT
                ]);
                BatteryTest::create([
                    'test_id' => $test->id,
                    'battery_id' => $battery->id
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('gender');
        });

        $batteries = \App\Models\Battery::all();
        foreach ($batteries as $battery) {
            BatteryTest::whereBatteryId($battery->id)->delete();
            $battery->delete();
        }

        Schema::table('batteries', function (Blueprint $table) {
            $table->dropColumn('is_default');
        });
    }
}
