<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Models\ClientBattery;
use App\Models\ClientTestResult;
use App\Models\ClientTestResultQuestion;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use mysql_xdevapi\Exception;

class ClientBatteryController extends Controller
{
    public function validateClient(Request $request) {
        $personalCode = $request->get('personal_code');
        $birthDate = $request->get('birth_date');
        $client = Client::getClientByPersonalCodeAndBirthDate($personalCode, $birthDate);
        if (!$client) {
            return response()->json(['error' => true, 'message' => 'Your information is not correct']);
        }
        $clientBattery = ClientBattery::getActivatingClientBatteryForTest($client->id);
        if (!$clientBattery) {
            return response()->json(['error' => true, 'message' => 'You do not have any test now']);
        }
        return response()->json([
            'client' => $client,
            'clientBattery' => $clientBattery,
            'battery' => $clientBattery->battery,
            'tests' => $clientBattery->battery->getTests(true)
        ]);
    }

    public function save(Request $request) {
        $clientId = $request->get('clientId');
        $testResultData = $request->get('testResultData');
        try {
            \DB::beginTransaction();

            $clientBattery = $this->getActivatingClientBatteryForTestOrFail($clientId);

            foreach ($testResultData as $testId => $testData) {
                $test = Test::findOrFail($testId);
                $clientTestResult = ClientTestResult::create([
                    'client_id' => $clientId,
                    'test_id' => $testId,
                    'title' => $test->title,
                    'config' => $test->config,
                    'description' => $test->description
                ]);
                foreach ($testData as $questionId => $score) {
                    $question = Question::findOrFail($questionId);
                    switch ($question->type) {
                        case Question::TYPE_FOUR_OPTIONS:
                        case Question::TYPE_TEN_OPTIONS:
                            ClientTestResultQuestion::create([
                                'test_result_id' => $clientTestResult->id,
                                'question_id' => $question->id,
                                'title' => $question->title,
                                'config' => $question->config,
                                'type' => $question->type,
                                'score' => $score
                            ]);
                            break;
                    }
                }
                //For now, test data will not modify, it save to store on config
                $clientTestResult->calcTestSummary();
            }
            $clientBattery->status = ClientBattery::STATUS_FINISHED;
            $clientBattery->save();

            \DB::commit();
        } catch (\Exception $ex) {
            \DB::rollBack();
        }
    }

    protected function getActivatingClientBatteryForTestOrFail($clientId) {
        $clientBattery = ClientBattery::getActivatingClientBatteryForTest($clientId);
        if (!$clientBattery) {
            throw new \Exception("No test found");
        }
        return $clientBattery;
    }
}
