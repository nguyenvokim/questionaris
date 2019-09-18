<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Question
 *
 * @property int $id
 * @property int $test_id
 * @property int $type
 * @property string $title
 * @property string $config
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereTestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'title',
        'config',
        'test_id',
        'type'
    ];

    protected $casts = array(
        'config' => 'array'
    );

    const TYPE_FOUR_OPTIONS = 1;
    const TYPE_TEN_OPTIONS = 2;

}
