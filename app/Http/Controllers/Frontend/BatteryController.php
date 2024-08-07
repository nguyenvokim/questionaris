<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Battery\CreateBatteryRequest;
use App\Http\Requests\Frontend\Battery\UpdateBatteryRequest;
use App\Models\Battery;
use App\Models\BatteryTest;
use App\Models\Test;
use Illuminate\Http\Request;

class BatteryController extends Controller
{
    public function index() {
        $paginator = Battery::where([
            ['user_id', '=', \Auth::id()]
        ])->orderByDesc('is_default')->paginate(20);
        return view('frontend.batteries.index', [
            'paginator' => $paginator
        ]);
    }

    public function createView() {
        $tests = Test::all();
        $testJson = $this->getTestsJson();
        return view('frontend.batteries.create', [
            'tests' => $tests,
            'testJson' => $testJson
        ]);
    }

    public function create(CreateBatteryRequest $createBatteryRequest) {
        $testIds = explode(",", $createBatteryRequest->get('test_ids'));
        $name = $createBatteryRequest->get('name');
        $oldBattery = Battery::getByName($name);
        if ($oldBattery) {
            $createBatteryRequest->flash();
            return redirect(route('frontend.battery.createView'))
                ->withFlashDanger('There is already another battery with the same name. Please choose a different name for this battery.');
        }
        $userOrg = \Auth::user()->getUserOrg();
        $battery = Battery::create([
            'user_id' => \Auth::id(),
            'name' => $name,
            'org_id' => $userOrg->id,
        ]);
        foreach ($testIds as $testId) {
            BatteryTest::create([
                'test_id' => $testId,
                'battery_id' => $battery->id
            ]);
        }

        return redirect(route('frontend.battery.index'))->withFlashSuccess('Battery successfully created!');
    }

    public function editView($id) {
        $battery = Battery::getUserBattery($id);
        if (!$battery OR $battery->is_default == Battery::BATTERY_DEFAULT) {
            return redirect(route('frontend.battery.index'));
        }
        $testJson = $this->getTestsJson();
        $tests = $battery->getTests();
        $testIdsJson = $tests->map(function ($test) {
            return $test->id;
        })->toJson();
        return view('frontend.batteries.edit', [
            'battery' => $battery,
            'testJson' => $testJson,
            'tests' => $tests,
            'testIdsJson' => $testIdsJson
        ]);
    }
    public function edit($id, UpdateBatteryRequest $updateBatteryRequest) {
        $testIds = explode(",", $updateBatteryRequest->get('test_ids'));
        $name = $updateBatteryRequest->get('name');
        $oldBattery = Battery::getByName($name);
        if ($oldBattery && $oldBattery->id != $id) {
            return redirect(route('frontend.battery.editView', ['id' => $id]))
                ->withFlashDanger('There is already another battery with the same name. Please choose a different name for this battery.');
        }
        $battery = Battery::getUserBattery($id);
        if (!$battery OR $battery->is_default == Battery::BATTERY_DEFAULT) {
            return redirect(route('frontend.battery.index'));
        }
        $battery->update([
            'name' => $name
        ]);
        BatteryTest::deleteByBatteryId($battery->id);
        foreach ($testIds as $testId) {
            BatteryTest::create([
                'test_id' => $testId,
                'battery_id' => $battery->id
            ]);
        }

        return redirect(route('frontend.battery.editView', ['id' => $id]))->withFlashSuccess('Battery successfully updated!');
    }

    public function clientBattery($batteryId) {
        $battery = Battery::find($batteryId);
        if (!$battery) {
            abort(404);
        }
        return view('frontend.batteries.clientBattery', [
            'batteryId' => $batteryId
        ]);
    }

    protected function getTestsJson() {
        return Test::all()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title
            ];
        })->toJson();
    }
}
