<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiOrderController;
use App\Http\Controllers\ApiProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [ApiAuthController::class, 'login']);
    Route::get('/refresh', [ApiAuthController::class, 'refresh']);
    Route::post('/register', [ApiAuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [ApiAuthController::class, 'logout']);
        Route::get('/user', [ApiAuthController::class, 'user']);
    });
});

Route::get('/products/random', [ApiProductController::class, 'random']);

Route::apiResource('products', ApiProductController::class)->only('index', 'show');

Route::get('/orders', [ApiOrderController::class, 'orders']);
Route::get('/order/{id}', [ApiOrderController::class, 'show']);
Route::post('/order/submit', [ApiOrderController::class, 'submit']);
Route::post('/pre-order/submit', [ApiOrderController::class, 'preOrderSubmit']);
Route::get('/pre-order/{product_id}', [ApiOrderController::class, 'preOrder']);
