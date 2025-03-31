<?php

use App\Http\Controllers\Api\InstanceController;
use Illuminate\Support\Facades\Route;

Route::prefix('instance/')->group(function () {

    Route::middleware('auth:api')->group(function () {
        Route::apiResource('', InstanceController::class);
    });
});
