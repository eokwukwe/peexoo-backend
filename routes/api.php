<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BusinessActivationController;



Route::group([], function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::post('register', [AuthController::class, 'register']);

    Route::apiResource('businesses', BusinessController::class)
        ->only('index', 'show');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('categories', CategoryController::class);

    Route::apiResource('businesses', BusinessController::class)
        ->except('index', 'show');

    Route::put(
        'businesses/{business}/toggleActivation',
        BusinessActivationController::class
    );
});
