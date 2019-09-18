<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Frontend\Api\CreateUserBatteryRequest;
use App\Models\Battery;
use App\Models\Client;
use App\Models\ClientBattery;
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

    public function createUserBattery(CreateUserBatteryRequest $request) {
        $activatingClientBattery = ClientBattery::getActivatingClientBattery($request->get('client_id'));
        if ($activatingClientBattery) {
            return response()->json($activatingClientBattery);
        }
        $clientBattery = ClientBattery::create($request->all());
        return response()->json(ClientBattery::getActivatingClientBattery($clientBattery->client_id));
    }
}
