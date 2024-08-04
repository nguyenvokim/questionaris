<?php

Route::group(['middleware' => 'auth', 'prefix' => 'api'], function() {

});

Route::group(['middleware' => 'master', 'prefix' => 'api'], function() {
    Route::post('userManager/inviteUser', 'Api\UserManagerController@inviteUser')->name('api.usermanager.inviteUser');
});
