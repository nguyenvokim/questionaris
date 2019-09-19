<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Models\ClientBattery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
