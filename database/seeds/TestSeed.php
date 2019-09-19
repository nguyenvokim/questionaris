<?php

use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\Answer;
use App\Models\Question;

class TestSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firstTest = Test::find(1);
        if (!$firstTest) {
            $this->createFirstTest();
        }
        $secondTest = Test::find(2);
        if (!$secondTest) {
            $this->createSecondTest();
        }
    }

    public function createFirstTest() {
        $test = new Test();
        $test->id = 1;
        $test->title = "DASS21";
        $test->config = [
            'summaryOptions' => [
                [
                    'name' => 'Depression subscale',
                    'items' => [3, 5, 10, 13, 16, 17, 21]
                ],
                [
                    'name' => 'Anxiety subscale',
                    'items' => [2, 4, 7, 9, 15, 19, 20]
                ],
                [
                    'name' => 'Stress subscale',
                    'items' => [1, 6, 8, 11, 12, 14, 18]
                ],
            ],
            'isShowHeaderTable' => true
        ];
        $test->description = "This brief questionnaire evaluates your general mood and levels of stress and anxiety over the past week.<br/>
            <br/>
            Please read each statement and select the option that indicates how much the statement applied to you OVER THE PAST WEEK. There are no right or wrong answers. Do not spend too much time on any statement.<br/>
               <br/>
            The rating scale is as follows:<br/>
            <br/>
            0  -  Did not apply to me at all - NEVER<br/>
            1  -  Applied to me to some degree, or some of the time - SOMETIMES<br/>
            2  -  Applied to me to a considerable degree, or a good part of time - OFTEN<br/>
            3  -  Applied to me very much, or most of the time - ALMOST ALWAYS<br/>";
        $test->save();

        $baseQuestionArr = [
            'test_id' => 1,
            'type' => Question::TYPE_FOUR_OPTIONS,
            'config' => []
        ];

        $questionsArr = [
            array_merge($baseQuestionArr, [
                'title' => 'I found it hard to wind down',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I was aware of dryness of my mouth',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I couldn’t seem to experience any positive feeling at all',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I experienced breathing difficulty (eg, excessively rapid breathing, breathlessness in the absence of physical exertion)',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I found it difficult to work up the initiative to do things',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I tended to over-react to situations',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I experienced trembling (eg, in the hands)',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I felt that I was using a lot of nervous energy',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I was worried about situations in which I might panic and make a fool of myself',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I felt that I had nothing to look forward to',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I found myself getting agitated',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I found it difficult to relax',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I found it difficult to relax',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I felt down-hearted and blue',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I was intolerant of anything that kept me from getting on with what I was doing',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I felt I was close to panic',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I was unable to become enthusiastic about anything',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I felt I wasn’t worth much as a person',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I felt that I was rather touchy',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I was aware of the action of my heart in the absence of physical exertion (eg, sense of heart rate increase, heart missing a beat)',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I felt scared without any good reason',
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'I felt that life was meaningless',
            ]),
        ];
        foreach ($questionsArr as $questionArr) {
            Question::create($questionArr);
        }
    }

    public function createSecondTest() {
        $test = new Test();
        $test->id = 2;
        $test->title = "SIDAS";
        $test->config = [];
        $test->description = "The following questions are about thoughts and behaviours relating to ending your life by suicide. Answering these will help your treating mental health professional to assess your safety and help you manage it. Please read each statement and answer using the 0 to 10 scale.";
        $test->save();
        $baseQuestionArr = [
            'test_id' => 2,
            'type' => Question::TYPE_TEN_OPTIONS,
        ];
        $questionsArr = [
            array_merge($baseQuestionArr, [
                'title' => 'In the past week, how often have you had thoughts about suicide?',
                'config' => [
                    'startText' => 'Never',
                    'endText' => 'Always',
                    'isReverser' => false
                ]
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'In the past week, how much control have you had over these thoughts? (If you answered 0 to the previous question, please enter 0 here)',
                'config' => [
                    'startText' => 'No control',
                    'endText' => 'Full control',
                    'isReverser' => true
                ]
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'In the past week, how close have you come to making a suicide attempt?',
                'config' => [
                    'startText' => 'Not close at all',
                    'endText' => 'Made an attempt',
                    'isReverser' => false
                ]
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'In the past week, to what extent have you felt tormented by thoughts about suicide?',
                'config' => [
                    'startText' => 'Not at all',
                    'endText' => 'Extremely',
                    'isReverser' => false
                ]
            ]),
            array_merge($baseQuestionArr, [
                'title' => 'In the past week, how much have thoughts about suicide interfered with your ability to carry out daily activities, such as work, household tasks or social activities?',
                'config' => [
                    'startText' => 'Not at all',
                    'endText' => 'Extremely',
                    'isReverser' => false
                ]
            ]),
        ];
        foreach ($questionsArr as $questionArr) {
            Question::create($questionArr);
        }
    }
}
