<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Battery
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery whereUserId($value)
 * @property int $is_default
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery whereIsDefault($value)
 * @property int $org_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battery whereOrgId($value)
 */
class Battery extends Model
{
    protected $table = "batteries";

    const BATTERY_DEFAULT = 1;
    const BATTERY_NOT_DEFAULT = 0;

    protected $fillable = [
        'user_id',
        'name',
        'is_default',
        'org_id',
    ];

    protected $attributes = [
        'is_default' => 0
    ];

    public function getTests($withQuestion = false) {
        $batteryTests = BatteryTest::whereBatteryId($this->id)->get();
        $tests = [];
        foreach ($batteryTests as $batteryTest) {
            if ($withQuestion) {
                $tests[] = Test::with('questions')->find($batteryTest->test_id);
            } else {
                $tests[] = $batteryTest->test;
            }
        }
        return collect($tests);
    }
    public function getTestNameArr() {
        $tests = $this->getTests();
        return $tests->map(function ($test) {
            return $test->title;
        })->toArray();
    }

    /**
     * @param $id
     * @return Battery
     */
    public static function getUserBattery($id) {
        return Battery::where([
            ['user_id', '=', \Auth::id()],
            ['id', '=', $id]
        ])->first();
    }

    public static function getBatteries() {
        return Battery::where([
            ['user_id', '=', \Auth::id()]
        ])->get();
    }

    public static function createDefaultBatteryForUser(User $user) {
        $tests = Test::all();
        $userOrg = $user->getUserOrg();
        foreach ($tests as $test) {
            $battery = \App\Models\Battery::create([
                'user_id' => $user->id,
                'name' => $test->title,
                'is_default' => self::BATTERY_DEFAULT,
                'org_id' => $userOrg->id,
            ]);
            BatteryTest::create([
                'test_id' => $test->id,
                'battery_id' => $battery->id
            ]);
        }
    }

    public static function getByName($name) {
        return Battery::whereName($name)->first();
    }
}
