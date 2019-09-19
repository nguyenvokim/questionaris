<?php
Route::group(['middleware' => 'auth', 'prefix' => 'api'], function() {
    Route::get('dashboard', 'Api\UserDashboard@index')->name('api.dashboard');
    Route::get('dashboard/activatingClientBattery/{clientId}', 'Api\UserDashboard@getActivatingClientBattery')->name('api.dashboard.activatingClientBattery');
    Route::post('dashboard/checkUserBattery', 'Api\UserDashboard@checkUserBattery')->name('api.dashboard.checkUserBattery');
});