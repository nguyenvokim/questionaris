<?php
Route::group(['middleware' => 'auth', 'prefix' => 'api'], function() {
    Route::delete('batteries/{batteryId}', 'Api\BatteryApiController@deleteBattery')->name('api.battery.delete');
});