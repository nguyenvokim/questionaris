<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\UserOrgRoleRule
 *
 * @property int $id
 * @property int $user_id
 * @property int $org_id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserOrgRoleRule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserOrgRoleRule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserOrgRoleRule query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserOrgRoleRule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserOrgRoleRule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserOrgRoleRule whereOrgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserOrgRoleRule whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserOrgRoleRule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserOrgRoleRule whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\UserOrg $org
 * @property-read \App\Models\Auth\User $user
 */
class UserOrgRole extends Model
{
    const ROLE_MASTER = 'MASTER';
    const ROLE_SUPERVISOR = 'SUPERVISOR';
    const ROLE_MEMBER = 'MEMBER';

    protected $fillable = [
        'user_id',
        'org_id',
        'role'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function org()
    {
        return $this->belongsTo(UserOrg::class, 'org_id', 'id');
    }
}
