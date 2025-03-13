<?php

use App\Http\Controllers\StripeWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);


$routeFiles = glob(__DIR__ . '/splitted_routes/*.php');

foreach ($routeFiles as $routeFile) {
    require $routeFile;
}