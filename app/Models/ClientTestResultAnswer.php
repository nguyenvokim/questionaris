<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClientTestResultAnswer
 *
 * @property int $id
 * @property int $test_result_question_id
 * @property string $title
 * @property string $config
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer whereConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer whereTestResultQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultAnswer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClientTestResultAnswer extends Model
{
    protected $table = 'client_test_result_answers';

    protected $casts = array(
        'config' => 'array'
    );
}
