<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiOrderController;
use App\Http\Controllers\ApiProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', [ApiAuthController::class, 'login']);
    Route::get('/refresh', [ApiAuthController::class, 'refresh']);

    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', [ApiAuthController::class, 'logout']);
        Route::get('/user', [ApiAuthController::class, 'user']);
    });
});

Route::apiResource('products', ApiProductController::class)->only('index', 'show');

Route::get('/orders', [ApiOrderController::class, 'orders']);
Route::get('/order/{id}', [ApiOrderController::class, 'show']);
Route::post('/order/submit', [ApiOrderController::class, 'submit']);
Route::post('/pre-order/submit', [ApiOrderController::class, 'preOrderSubmit']);
Route::get('/pre-order/{product_id}', [ApiOrderController::class, 'preOrder']);
