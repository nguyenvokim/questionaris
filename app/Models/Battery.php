<?php

namespace App\Models;

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
 */
class Battery extends Model
{
    protected $table = "batteries";

    protected $fillable = [
        'user_id',
        'name'
    ];

    public function getTests() {
        $batteryTests = BatteryTest::whereBatteryId($this->id)->get();
        $tests = [];
        foreach ($batteryTests as $batteryTest) {
            $tests[] = $batteryTest->test;
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
}
