<?php

namespace App\Models;

use App\Casts\ImportantArray;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

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
        'config' => ImportantArray::class
    );

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function test() {
        return $this->belongsTo(Test::class);
    }

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

        $clientTestResultQuestions = ClientTestResultQuestion::where('test_result_id', '=', $this->id)->get();
        $hiddenQuestionIds = [];
        if (isset($config['hiddenQuestionIds'])) {
            $hiddenQuestionIds = $config['hiddenQuestionIds'];
        };
        //hidden question will not effect to score
        $score = $clientTestResultQuestions->sum(function ($clientTestResultQuestion) use ($hiddenQuestionIds) {
            if (in_array($clientTestResultQuestion->question_id, $hiddenQuestionIds)) {
                return 0;
            }
            return $clientTestResultQuestion->score;
        });
        $config['score'] = $score;
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

    public static function getRecentTests() {
        $userId = \Auth::id();
        if (!$userId) {
            return [];
        }
        $result = ClientTestResult::with(['client', 'test'])
            ->select('ctr.*')
            ->from('client_test_results', 'ctr')
            ->leftJoin('clients', 'clients.id', '=', 'ctr.client_id')
            ->leftJoin('users', 'users.id', '=', 'clients.user_id')
            ->limit(50)
            ->orderBy('id', 'DESC')
            ->where('users.id', '=', $userId)
            ->get();
        return $result;
    }
}
