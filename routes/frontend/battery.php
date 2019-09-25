<?php

Route::group(['middleware' => 'auth'], function() {
    Route::get('batteries', 'BatteryController@index')->name('frontend.battery.index');
    Route::get('batteries/create', 'BatteryController@createView')->name('frontend.battery.createView');
    Route::post('batteries/create', 'BatteryController@create')->name('frontend.battery.create');
    Route::get('batteries/edit/{id}', 'BatteryController@editView')->name('frontend.battery.editView');
    Route::post('batteries/edit/{id}', 'BatteryController@edit')->name('frontend.battery.edit');
});

Route::get('clientBattery/{batteryId}', 'BatteryController@clientBattery')->name('frontend.battery.clientBattery');