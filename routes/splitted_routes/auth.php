<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth/')->group(function () {

    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('verify-register-otp', [AuthController::class, 'verifyRegisterOtp'])->name('auth.verifyRegisterOtp');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('request-login-otp', [AuthController::class, 'requestLoginOtp'])->name('auth.requestLoginOtp');
    Route::post('login-otp', [AuthController::class, 'loginWithOtp'])->name('auth.loginWithOtp');

    Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('otp/enable', [AuthController::class, 'otpEnable'])->middleware('auth:api');
    Route::post('request-otp', [AuthController::class, 'requestLoginOtp'])->middleware('auth:api');
    Route::post('login-otp', [AuthController::class, 'loginWithOtp'])->middleware('auth:api');
    });
});
