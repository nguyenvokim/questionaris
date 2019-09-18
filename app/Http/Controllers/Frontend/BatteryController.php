<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Battery\CreateBatteryRequest;
use App\Models\Battery;
use App\Models\BatteryTest;
use App\Models\Test;
use Illuminate\Http\Request;

class BatteryController extends Controller
{
    public function index() {
        $paginator = Battery::paginate(20);
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

        $battery = Battery::create([
            'user_id' => \Auth::id(),
            'name' => $name
        ]);
        foreach ($testIds as $testId) {
            BatteryTest::create([
                'test_id' => $testId,
                'battery_id' => $battery->id
            ]);
        }

        return redirect(route('frontend.battery.index'))->withFlashSuccess('Create battery success');
    }

    public function editView($id) {
        $battery = Battery::getUserBattery($id);
        if (!$battery) {
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
    public function edit($id, CreateBatteryRequest $createBatteryRequest) {
        $testIds = explode(",", $createBatteryRequest->get('test_ids'));
        $name = $createBatteryRequest->get('name');
        $battery = Battery::getUserBattery($id);
        if (!$battery) {
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

        return redirect(route('frontend.battery.editView', ['id' => $id]))->withFlashSuccess('Updated battery success');
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
