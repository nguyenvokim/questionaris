<?php

namespace App\Models;

use App\Casts\ImportantString;
use App\Models\Auth\User;
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
 * @property int $gender
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereGender($value)
 */
class Client extends Model
{

    use Notifiable;

    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;
    const GENDER_OTHER = 2;

    protected $table = 'clients';

    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'email',
        'personal_code',
        'birth_date',
        'user_id',
        'gender'
    ];

    protected $dates = [
        'birth_date',
    ];

    protected $casts = [
        'email' => ImportantString::class,
        'personal_code' => ImportantString::class
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getGenderText() {
        if ($this->gender == self::GENDER_MALE) {
            return  'Male';
        } elseif ($this->gender == self::GENDER_FEMALE) {
            return 'Female';
        } else {
            return 'Other';
        }
    }

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
     * @param $code
     * @return Client
     */
    public static function getUserClientByCode($personalCode) {
        return Client::where([
            ['user_id', '=', \Auth::id()],
            ['personal_code', '=', $personalCode]
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
        $clients = Client::where([
            ['birth_date', '=', $birthDate]
        ])->get();
        return $clients->first(function ($client, $key) use ($personalCode) {
            return $client->personal_code == $personalCode;
        });
    }
}
