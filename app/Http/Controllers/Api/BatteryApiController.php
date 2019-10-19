<?php

namespace App\Http\Controllers\Api;

use App\Models\Battery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BatteryApiController extends Controller
{
    public function deleteBattery($batteryId) {
        $battery = Battery::find($batteryId);
        if ($battery) {
            $battery->delete();
        }
        return response()->json(['success' => 1]);
    }
}
