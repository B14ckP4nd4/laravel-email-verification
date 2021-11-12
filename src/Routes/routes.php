<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is the Routes for Email Verification Process
|
*/


Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {

    $enableViews = config('fortify.views', true);

    // Email Verification...
    if ($enableViews) {
        Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
            ->middleware(['auth:' . config('fortify.guard')])
            ->name('verification.notice');
    }
//
//    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
//        ->middleware(['auth:' . config('fortify.guard'), 'signed', 'throttle:' . $verificationLimiter])
//        ->name('verification.verify');
//
//    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
//        ->middleware(['auth:' . config('fortify.guard'), 'throttle:' . $verificationLimiter])
//        ->name('verification.send');


});
