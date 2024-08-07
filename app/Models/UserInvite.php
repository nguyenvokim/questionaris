<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserInvite
 *
 * @property int $id
 * @property int $inviter_id
 * @property string $fist_name
 * @property string $last_name
 * @property string $email
 * @property string $invite_key
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite whereFistName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite whereInviteKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite whereInviterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite whereStatus($value)
 * @property string $first_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInvite whereFirstName($value)
 */
class UserInvite extends Model
{

    const STATUS_PENDING = 'PENDING';
    const STATUS_APPROVED = 'APPROVED';

    protected $fillable = [
        'inviter_id',
        'first_name',
        'last_name',
        'email',
        'invite_key',
        'role'
    ];
}
