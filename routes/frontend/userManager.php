<?php

use App\Http\Controllers\Frontend\UserManagerController;

Route::group(['middleware' => 'auth'], function() {
    Route::get('userManager', [UserManagerController::class, 'index'])->name('frontend.userManager.index');
});
