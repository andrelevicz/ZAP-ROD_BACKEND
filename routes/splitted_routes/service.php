<?php

use App\Http\Controllers\Api\ServiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('services/')->group(function () {

    Route::middleware('auth:api')->group(function () {
        Route::apiResource('', ServiceController::class);
    });
});
