<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClientTestResult
 *
 * @property int $id
 * @property int $client_id
 * @property int $test_id
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereTestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property array $config
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientTestResult whereConfig($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClientTestResultQuestion[] $test_result_questions
 * @property-read int|null $test_result_questions_count
 */
class ClientTestResult extends Model
{
    protected $table = 'client_test_results';

    protected $fillable = [
        'client_id',
        'test_id',
        'title',
        'config',
        'description'
    ];

    protected $casts = array(
        'config' => 'array'
    );

    public function test_result_questions() {
        return $this->hasMany(ClientTestResultQuestion::class, 'test_result_id', 'id');
    }

    public function calcTestSummary() {
        $config = $this->config;
        if (isset($config['summaryOptions'])) {
            $summaryOptions = $this->config['summaryOptions'];
            foreach ($summaryOptions as &$summaryOption) {
                $items = $summaryOption['items'];
                $totalScore = ClientTestResultQuestion::where('test_result_id', '=', $this->id)
                    ->whereIn('question_id', $items)
                    ->sum('score');
                $summaryOption['score'] = $totalScore;
            }
            $config['summaryOptions'] = $summaryOptions;
        }

        $config['score'] = ClientTestResultQuestion::where('test_result_id', '=', $this->id)
            ->sum('score');
        $this->config = $config;
        $this->save();
    }

    public static function getTestResultOfClientByTestId($clientId, $testId) {
        if ($testId == Test::TEST_SIDAS_ID) {
            return ClientTestResult::with('test_result_questions')
            ->where([
                ['client_id', '=', $clientId],
                ['test_id', '=', $testId]
            ])->orderBy('id', 'ASC')->get();
        } else {
            return ClientTestResult::where([
                ['client_id', '=', $clientId],
                ['test_id', '=', $testId]
            ])->orderBy('id', 'ASC')->get();
        }
    }
}
