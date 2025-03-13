
<?php

use App\Http\Controllers\Api\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::prefix('subscriptions/')->group(function () {

    Route::middleware('auth:api')->group(function () {
        Route::post('/plans', [SubscriptionController::class, 'createPlan']);
        Route::post('/subscriptions', [SubscriptionController::class, 'createSubscription']);
        Route::get('/subscriptions', [SubscriptionController::class, 'listSubscriptions']);
        Route::delete('/subscriptions/{id}', [SubscriptionController::class, 'cancelSubscription']);
    });
});


