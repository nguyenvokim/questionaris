<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClientTestResultQuestion
 *
 * @property int $id
 * @property int $test_result_id
 * @property int $question_id
 * @property string $title
 * @property string $config
 * @property int $type
 * @property int $score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereTestResultId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResultQuestion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClientTestResultQuestion extends Model
{
    protected $table = 'client_test_result_questions';

    protected $casts = array(
        'config' => 'array'
    );

    protected $fillable = array(
        'test_result_id',
        'question_id',
        'title',
        'config',
        'type',
        'score'
    );
}
