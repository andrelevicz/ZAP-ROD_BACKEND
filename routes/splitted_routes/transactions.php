<?php

use App\Http\Controllers\Api\TransactionsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    
    Route::prefix('transactions')->group(function () {

    });

    Route::apiResource('transactions', TransactionsController::class);
});
