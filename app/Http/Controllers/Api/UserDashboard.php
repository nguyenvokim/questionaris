<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Frontend\Api\BatteryEmailLinkRequest;
use App\Http\Requests\Frontend\Api\CreateUserBatteryRequest;
use App\Models\Battery;
use App\Models\Client;
use App\Models\ClientBattery;
use App\Models\ClientEmailLog;
use App\Models\ClientTestResult;
use App\Models\Test;
use App\Notifications\Frontend\BatteryLinkEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDashboard extends Controller
{
    public function index() {
        $clients = Client::getClients();
        $batteries = Battery::getBatteries();
        return response()->json([
            'clients' => $clients,
            'batteries' => $batteries,
        ]);
    }

    public function getActivatingClientBattery($clientId) {
        return response()->json(ClientBattery::getActivatingClientBattery($clientId));
    }

    public function createClientBattery(CreateUserBatteryRequest $request) {
        $activatingClientBattery = ClientBattery::getActivatingClientBattery($request->get('client_id'));
        if ($activatingClientBattery) {
            return response()->json($activatingClientBattery);
        }
        $clientBattery = ClientBattery::create($request->all());
        return response()->json(ClientBattery::getActivatingClientBattery($clientBattery->client_id));
    }

    public function getClientTestsInfo($clientId) {
        $client = Client::getUserClientById($clientId);
        $finishedTests = Test::getUniqueTestDoneOfClient($clientId);
        $detailTestResults = collect();
        if ($finishedTests->count()) {
            $firstTestId = $finishedTests[0]->id;
            $detailTestResults = ClientTestResult::getTestResultOfClientByTestId($clientId, $firstTestId);
        }
        return response()->json([
            'client' => $client,
            'finishedTests' => $finishedTests,
            'detailTestResults' => $detailTestResults
        ]);
    }

    public function getClientTestResults($clientId, $testId) {
        $client = Client::getUserClientById($clientId);
        if (!$client) {
            abort(404);
        }
        $detailTestResults = ClientTestResult::getTestResultOfClientByTestId($clientId, $testId);
        return response()->json($detailTestResults);
    }
    public function getClientDetailTestResult($id) {
        $clientTestResult = ClientTestResult::with('test_result_questions')
            ->find($id);
        return response()->json($clientTestResult);
    }

    public function createBatteryEmail(BatteryEmailLinkRequest $batteryEmailLinkRequest) {
        $client = Client::getUserClientById($batteryEmailLinkRequest->get('clientId'));
        if (!$client) {
            throw new \Exception("Client not correct");
        }
        $battery = Battery::findOrFail($batteryEmailLinkRequest->get('batteryId'));
        $client->notify(new BatteryLinkEmail($client, $battery));
        ClientEmailLog::create([
            'client_id' => $client->id,
            'relate_object_id' => $battery->id,
            'type' => ClientEmailLog::TYPE_BATTERY
        ]);
        return response()->json([
            'success' => 1
        ]);
    }
    public function lastBatteryEmail($clientId) {
        return response()->json(ClientEmailLog::getLastBatteryEmail($clientId));
    }
}
