<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $personal_code
 * @property string $birth_date
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePersonalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereUserId($value)
 * @mixin \Eloquent
 */
class Client extends Model
{

    use Notifiable;

    protected $table = 'clients';

    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'email',
        'personal_code',
        'birth_date',
        'user_id'
    ];

    /**
     * @param $email
     * @return Client
     */
    public static function getUserClientByEmail($email) {
        return Client::where([
            ['user_id', '=', \Auth::id()],
            ['email', '=', $email]
        ])->first();
    }

    /**
     * @param $id
     * @return Client
     */
    public static function getUserClientById($id) {
        return Client::where([
            ['user_id', '=', \Auth::id()],
            ['id', '=', $id]
        ])->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection[Client]
     */
    public static function getClients() {
        return Client::where([
            ['user_id', '=', \Auth::id()]
        ])->get();
    }

    /**
     * @param $personalCode
     * @param $birthDate
     * @return Client
     */
    public static function getClientByPersonalCodeAndBirthDate($personalCode, $birthDate) {
        return Client::where([
            ['personal_code', '=', $personalCode],
            ['birth_date', '=', $birthDate]
        ])->first();
    }
}
