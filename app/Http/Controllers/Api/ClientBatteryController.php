<?php

namespace App\Http\Controllers\Api;

use App\Models\Battery;
use App\Models\Client;
use App\Models\ClientBattery;
use App\Models\ClientTestResult;
use App\Models\ClientTestResultQuestion;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientBatteryController extends Controller
{
    public function validateClient(Request $request) {
        $personalCode = $request->get('personalCode');
        $birthDate = $request->get('birthDate');
        $batteryId = $request->get('batteryId');
        $client = Client::getClientByPersonalCodeAndBirthDate($personalCode, $birthDate);

        //$clientBattery = ClientBattery::getActivatingClientBatteryForTest($client->id);
        $battery = Battery::find($batteryId);
        if (!$client OR !$battery OR $client->user_id != $battery->user_id) {
            return response()->json(['error' => true, 'message' => 'Your information is not correct']);
        }
        return response()->json([
            'client' => $client,
            'clientBattery' => [],
            'battery' => $battery,
            'tests' => $battery->getTests(true)
        ]);
    }

    public function save(Request $request) {
        $clientId = $request->get('clientId');
        $testResultData = $request->get('testResultData');
        try {
            \DB::beginTransaction();

            //$clientBattery = $this->getActivatingClientBatteryForTestOrFail($clientId);

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
            //$clientBattery->status = ClientBattery::STATUS_FINISHED;
            //$clientBattery->save();

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
