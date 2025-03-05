<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CurrencyRateController;
use App\Http\Controllers\Api\RequestServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', 'logout');
        Route::get('user', 'me');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('requests', RequestServiceController::class);
    Route::middleware('can:is-admin')->get('rates', [CurrencyRateController::class, 'index']);
});
