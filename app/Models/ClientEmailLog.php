<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClientEmailLog
 *
 * @property int $id
 * @property int $client_id
 * @property int $type
 * @property int $relate_object_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog whereRelateObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientEmailLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClientEmailLog extends Model
{
    protected $table = 'client_email_logs';

    const TYPE_BATTERY = 1;

    protected $fillable = [
        'client_id',
        'type',
        'relate_object_id'
    ];

    protected $attributes = [
        'type' => self:: TYPE_BATTERY
    ];

    public static function getLastBatteryEmail($clientId) {
        return ClientEmailLog::where([
            ['client_id', '=', $clientId],
            ['type', '=', self::TYPE_BATTERY]
        ])->orderByDesc('id')->first();
    }
}
