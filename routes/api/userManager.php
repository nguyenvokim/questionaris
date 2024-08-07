<?php

Route::group(['middleware' => 'auth', 'prefix' => 'api'], function() {

});

Route::group(['middleware' => 'master', 'prefix' => 'api'], function() {
    Route::post('userManager/inviteUser', 'Api\UserManagerController@inviteUser')->name('api.usermanager.inviteUser');
    Route::get('userManager/invites', 'Api\UserManagerController@invites')->name('api.usermanager.invites');
    Route::get('userManager/users', 'Api\UserManagerController@users')->name('api.usermanager.users');
    Route::post('userManager/invites/{id}/resend', 'Api\UserManagerController@resendInvite')->name('api.usermanager.resendInvite');
});
