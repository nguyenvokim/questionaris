<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Test;
use App\Models\Question;
use App\Models\Battery;
use App\Models\BatteryTest;
use App\Models\Auth\User;

class AddTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->addTestK10();
        $this->addTestK10Plus();
        $this->addDefaultBattery();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Question::where('test_id', '=', Test::TEST_K10_ID)->delete();
        Test::where('id', '=', Test::TEST_K10_ID)->delete();
        Question::where('test_id', '=', Test::TEST_K10_PLUS_ID)->delete();
        Test::where('id', '=', Test::TEST_K10_PLUS_ID)->delete();

        BatteryTest::where('test_id', '=', Test::TEST_K10_ID)->delete();
        BatteryTest::where('test_id', '=', Test::TEST_K10_PLUS_ID)->delete();

        Battery::where('name', '=', 'K10')->delete();
        Battery::where('name', '=', 'K10+')->delete();
    }

    public function addTestK10() {
        $test = new Test();
        $test->id = Test::TEST_K10_ID;
        $test->title = "K10";
        $test->config = [
            'summaryOptions' => [
            ],
            'isShowHeaderTable' => true,
            'headers' => [
                'In the past 4 weeks:',
                'None of the time',
                'A little of the time',
                'Some of the time',
                'Most of the time'
            ]
        ];
        $test->description = "The following are questions about how you have been feeling over the past <strong>4 weeks</strong>.<br/>";
        $test->description .= "Please select the most appropriate response for each question.";
        $test->save();

        $baseQuestionArr = [
            'test_id' => Test::TEST_K10_ID,
            'type' => Question::TYPE_FIVE_OPTIONS,
            'config' => []
        ];
        $questionsArr = [
            array_merge($baseQuestionArr, [
                'id' => 28,
                'title' => 'About how often did you feel tired out for no good reason?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 29,
                'title' => 'About how often did you feel nervous?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 30,
                'title' => 'About how often did you feel so nervous that nothing could calm you down?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 31,
                'title' => 'About how often did you feel hopeless?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 32,
                'title' => 'About how often did you feel restless or fidgety?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 33,
                'title' => 'About how often did you feel so restless you could not sit still?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 34,
                'title' => 'About how often did you feel depressed?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 35,
                'title' => 'About how often did you feel that everything was an effort?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 36,
                'title' => 'About how often did you feel so sad that nothing could cheer you up?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 37,
                'title' => 'About how often did you feel worthless?',
            ]),
        ];

        foreach ($questionsArr as $questionArr) {
            $this->addQuestionFromArray($questionArr);
        }
    }

    public function addTestK10Plus() {
        $test = new Test();
        $test->id = Test::TEST_K10_PLUS_ID;
        $test->title = "K10+";
        $test->config = [
            'summaryOptions' => [
            ],
            'hasHiddenQuestion' => true,
            'hiddenQuestionIds' => [48, 49, 50, 51],
            'hiddenQuestionCondition' => [
                'type' => 'SCORE_LOWER',
                'value' => 50
            ],
            'hiddenQuestionDescription' => 'The next few questions are about how these feelings may have affected you in the past <strong>4
weeks.</strong>'
        ];
        $test->description = "The following are questions about how you have been feeling over the past <strong>4 weeks</strong>.<br/>";
        $test->description .= "Please select the most appropriate response for each question.";
        $test->save();

        $baseQuestionArr = [
            'test_id' => Test::TEST_K10_PLUS_ID,
            'type' => Question::TYPE_FIVE_OPTIONS,
            'config' => []
        ];
        $questionsArr = [
            array_merge($baseQuestionArr, [
                'id' => 38,
                'title' => 'About how often did you feel tired out for no good reason?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 39,
                'title' => 'About how often did you feel nervous?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 40,
                'title' => 'About how often did you feel so nervous that nothing could calm you down?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 41,
                'title' => 'About how often did you feel hopeless?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 42,
                'title' => 'About how often did you feel restless or fidgety?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 43,
                'title' => 'About how often did you feel so restless you could not sit still?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 44,
                'title' => 'About how often did you feel depressed?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 45,
                'title' => 'About how often did you feel that everything was an effort?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 46,
                'title' => 'About how often did you feel so sad that nothing could cheer you up?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 47,
                'title' => 'About how often did you feel worthless?',
            ]),
            array_merge($baseQuestionArr, [
                'id' => 48,
                'title' => 'In the last 4 weeks, how many days were you TOTALLY UNABLE to work, study or manage your day-to-day activities because of these feelings?',
                'type' => Question::TYPE_DYNAMIC_RANGE_SELECTION,
                'config' => ['start' => 0, 'end' => 28]
            ]),
            array_merge($baseQuestionArr, [
                'id' => 49,
                'title' => 'Aside from those days, in the last 4 weeks, how many days were you able to work or study or manage your day-to-day activities, but had to CUT DOWN on what you did because of these feelings?',
                'type' => Question::TYPE_DYNAMIC_RANGE_SELECTION,
                'config' => ['start' => 0, 'end' => 28]
            ]),
            array_merge($baseQuestionArr, [
                'id' => 50,
                'title' => 'In the last 4 weeks, how many times have you seen a doctor or any other health professional about these feelings?',
                'type' => Question::TYPE_DYNAMIC_RANGE_SELECTION,
                'config' => ['start' => 0, 'end' => 28]
            ]),
            array_merge($baseQuestionArr, [
                'id' => 51,
                'title' => 'In the last 4 weeks, how often have physical health problems been the main cause of these feelings?',
            ]),
        ];

        foreach ($questionsArr as $questionArr) {
            $this->addQuestionFromArray($questionArr);
        }
    }


    private function addQuestionFromArray($questionArr) {
        $question = new Question();
        $question->id = $questionArr['id'];
        $question->test_id = $questionArr['test_id'];
        $question->config = $questionArr['config'];
        $question->type = $questionArr['type'];
        $question->title = $questionArr['title'];
        $question->save();
    }

    private function addDefaultBattery() {
        $users = User::all();
        $testK10 = Test::find(Test::TEST_K10_ID);
        $testK10Plus = Test::find(Test::TEST_K10_PLUS_ID);
        foreach ($users as $user) {
            $batteryK10 = \App\Models\Battery::create([
                'user_id' => $user->id,
                'name' => $testK10->title,
                'is_default' => \App\Models\Battery::BATTERY_DEFAULT
            ]);
            BatteryTest::create([
                'test_id' => $testK10->id,
                'battery_id' => $batteryK10->id
            ]);

            $batteryK10Plus = \App\Models\Battery::create([
                'user_id' => $user->id,
                'name' => $testK10Plus->title,
                'is_default' => \App\Models\Battery::BATTERY_DEFAULT
            ]);
            BatteryTest::create([
                'test_id' => $testK10Plus->id,
                'battery_id' => $batteryK10Plus->id
            ]);
        }
    }
}
