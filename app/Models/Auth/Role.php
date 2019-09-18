<?php

namespace App\Models\Auth;

use Altek\Accountant\Contracts\Recordable;
use App\Models\Auth\Traits\Method\RoleMethod;
use Spatie\Permission\Models\Role as SpatieRole;
use Altek\Accountant\Recordable as RecordableTrait;

/**
 * Class Role.
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Altek\Accountant\Models\Ledger[] $ledgers
 * @property-read int|null $ledgers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Auth\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Spatie\Permission\Models\Role permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Auth\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends SpatieRole implements Recordable
{
    use RecordableTrait,
        RoleMethod;
}
