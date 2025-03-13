<?php

use App\Http\Controllers\Api\CompanyController;
use Illuminate\Support\Facades\Route;

Route::prefix('company/')->group(function () {

    Route::middleware('auth:api')->group(function () {
        Route::apiResource('', CompanyController::class);
    });
});
