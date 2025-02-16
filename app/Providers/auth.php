<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth/')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('otp/enable', [AuthController::class, 'otpEnable'])->middleware('auth:api');
    Route::post('request-otp', [AuthController::class, 'requestLoginOtp'])->middleware('auth:api');
    Route::post('login-otp', [AuthController::class, 'loginWithOtp'])->middleware('auth:api');

});
