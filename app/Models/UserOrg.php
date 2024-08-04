<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserOrg
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrg whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Auth\User $user
 */
class UserOrg extends Model
{
    protected $table = 'user_orgs';

    protected $fillable = [
        'user_id',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
