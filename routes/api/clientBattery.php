<?php
Route::group(['prefix' => 'api'], function() {
    Route::post('clientBattery/validateClient', 'Api\ClientBatteryController@validateClient')->name('api.clientBattery.validateClient');
    Route::post('clientBattery/save', 'Api\ClientBatteryController@save')->name('api.clientBattery.save');
});