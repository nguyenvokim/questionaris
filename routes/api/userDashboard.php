<?php
Route::group(['middleware' => 'auth', 'prefix' => 'api'], function() {
    Route::get('dashboard', 'Api\UserDashboard@index')->name('api.dashboard');
    Route::get('dashboard/activatingClientBattery/{clientId}', 'Api\UserDashboard@getActivatingClientBattery')->name('api.dashboard.activatingClientBattery');
    Route::post('dashboard/createdClientBattery', 'Api\UserDashboard@createClientBattery')->name('api.dashboard.createClientBattery');
    Route::post('dashboard/sendEmailBattery', 'Api\UserDashboard@createBatteryEmail')->name('api.dashboard.sendEmailBattery');
    Route::get('dashboard/clientTestsInfo/{clientId}', 'Api\UserDashboard@getClientTestsInfo')->name('api.dashboard.clientTestsInfo');
    Route::get('dashboard/clientTestResults/{clientId}/{testId}', 'Api\UserDashboard@getClientTestResults')->name('api.dashboard.clientTestResults');
    Route::get('dashboard/clientDetailTestResult/{id}', 'Api\UserDashboard@getClientDetailTestResult')->name('api.dashboard.clientDetailTestResult');
    Route::get('dashboard/lastBatteryEmail/{clientId}', 'Api\UserDashboard@lastBatteryEmail')->name('api.dashboard.lastBatteryEmail');
});