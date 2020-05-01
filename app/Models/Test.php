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
 * @property string|null $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Test whereDescription($value)
 */
class Test extends Model
{

    //Test is hard code, feel safe to had const
    const TEST_DASS_ID = 1;
    const TEST_SIDAS_ID = 2;
    const TEST_K10_ID = 3;
    const TEST_K10_PLUS_ID = 4;
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

    /**
     * @param $clientId
     * @return \Illuminate\Support\Collection
     */
    public static function getUniqueTestDoneOfClient($clientId) {
        $clientTestResults = ClientTestResult::where('client_id', '=', $clientId)
            ->groupBy(['test_id'])
            ->get();
        $testIds = $clientTestResults->map(function ($clientTestResult) {
            return $clientTestResult->test_id;
        });
        return Test::whereIn('id', $testIds)->get();
    }
}
