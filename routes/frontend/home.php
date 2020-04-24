<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])->name('frontend.index');
Route::get('contact', [ContactController::class, 'index'])->name('frontend.contact');
Route::post('contact/send', [ContactController::class, 'send'])->name('frontend.contact.send');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    // User Dashboard Specific
    Route::get('dashboard', [DashboardController::class, 'index'])->name('frontend.user.dashboard');
    // User Account Specific
    Route::get('account', [AccountController::class, 'index'])->name('frontend.user.account');

    // User Profile Specific
    Route::patch('profile/update', [ProfileController::class, 'update'])->name('frontend.user.profile.update');
});
