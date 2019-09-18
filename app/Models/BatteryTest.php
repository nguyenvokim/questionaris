<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BatteryTest
 *
 * @property int $id
 * @property int $test_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest whereTestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest whereOrder($value)
 * @property int $battery_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BatteryTest whereBatteryId($value)
 * @property-read \App\Models\Test $test
 */
class BatteryTest extends Model
{
    protected $table = 'battery_test';

    protected $attributes = [
        'order' => 0
    ];

    protected $fillable = [
        'test_id',
        'battery_id'
    ];

    public function test() {
        return $this->hasOne(Test::class, 'id', 'test_id');
    }

    public static function deleteByBatteryId($batteryId) {
        BatteryTest::where('battery_id', '=', $batteryId)->delete();
    }
}
