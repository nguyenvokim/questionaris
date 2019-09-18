<?php

use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\SocialLoginController;
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\Auth\ConfirmAccountController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\Auth\UpdatePasswordController;
use App\Http\Controllers\Frontend\Auth\PasswordExpiredController;

/*
 * Frontend Access Controllers
 * All route names are prefixed with 'frontend.auth'.
 */
Route::group(['namespace' => 'Auth'], function () {
    // These routes require the user to be logged in
    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('frontend.auth.logout');

        // These routes can not be hit if the password is expired
        Route::group(['middleware' => 'password_expires'], function () {
            // Change Password Routes
            Route::patch('password/update', [UpdatePasswordController::class, 'update'])->name('frontend.auth.password.update');
        });

        // Password expired routes
        Route::get('password/expired', [PasswordExpiredController::class, 'expired'])->name('frontend.auth.password.expired');
        Route::patch('password/expired', [PasswordExpiredController::class, 'update'])->name('frontend.auth.password.expired.update');
    });

    // These routes require no user to be logged in
    Route::group(['middleware' => 'guest'], function () {
        // Authentication Routes
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('frontend.auth.login');
        Route::post('login', [LoginController::class, 'login'])->name('frontend.auth.login.post');

        // Socialite Routes
        Route::get('login/{provider}', [SocialLoginController::class, 'login'])->name('frontend.auth.social.login');
        Route::get('login/{provider}/callback', [SocialLoginController::class, 'frontend.auth.login']);

        // Registration Routes
        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('frontend.auth.register');
        Route::post('register', [RegisterController::class, 'register'])->name('frontend.auth.register.post');

        // Confirm Account Routes
        Route::get('account/confirm/{token}', [ConfirmAccountController::class, 'confirm'])->name('frontend.auth.account.confirm');
        Route::get('account/confirm/resend/{uuid}', [ConfirmAccountController::class, 'sendConfirmationEmail'])->name('frontend.auth.account.confirm.resend');

        // Password Reset Routes
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('frontend.auth.password.email');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('frontend.auth.password.email.post');

        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('frontend.auth.password.reset.form');
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('frontend.auth.password.reset');
    });
});
