<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClientBattery
 *
 * @property int $id
 * @property int $client_id
 * @property int $battery_id
 * @property string $start_date
 * @property string $end_date
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereBatteryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientBattery whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Battery $battery
 * @property-read \App\Models\Client $client
 */
class ClientBattery extends Model
{

    const STATUS_WAITING_FOR_CLIENT = 1;
    const STATUS_CANCEL = 2;
    const STATUS_TIME_EXPIRED= 3;
    const STATUS_FINISHED = 4;

    protected $table = 'client_batteries';

    protected $dates = [
        'start_date',
        'end_date'
    ];

    protected $fillable = [
        'client_id',
        'battery_id',
        'start_date',
        'end_date',
        'status'
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d'
    ];

    protected $attributes = [
        'status' => self::STATUS_WAITING_FOR_CLIENT
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function battery()
    {
        return $this->belongsTo(Battery::class);
    }

    /**
     * @param $clientId
     * @return ClientBattery
     */
    public static function getActivatingClientBattery($clientId)
    {
        $clientBattery = ClientBattery::with(['client', 'battery'])
            ->join('clients', 'clients.id', '=', 'client_id')
            ->where([
                ['client_id', '=', $clientId],
                ['status', '=', self::STATUS_WAITING_FOR_CLIENT],
                ['clients.user_id', '=', \Auth::id()],
                ['start_date' , '<' , Carbon::now()],
                ['end_date', '>', Carbon::now()->subDay()]
            ])->first();

        return $clientBattery;
    }

    /**
     * @param $clientId
     * @return ClientBattery
     */
    public static function getActivatingClientBatteryForTest($clientId)
    {
        $clientBattery = ClientBattery::with(['client', 'battery'])
            ->where([
                ['client_id', '=', $clientId],
                ['status', '=', self::STATUS_WAITING_FOR_CLIENT],
                ['start_date' , '<' , Carbon::now()],
                ['end_date', '>', Carbon::now()->subDay()]
            ])->first();

        return $clientBattery;
    }
}
