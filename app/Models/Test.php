<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Test
 *
 * @property int $id
 * @property string $title
 * @property string $config
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test whereConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Test extends Model
{
    protected $table = 'tests';

    protected $fillable = [
        'title',
        'config'
    ];

    protected $casts = array(
        'config' => 'array'
    );

    public function questions() {
        return $this->hasMany(Question::class);
    }
}
