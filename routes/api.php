<?php

use App\Http\Controllers\ApiCartController;
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

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ApiProductController::class, 'index']);
    Route::get('/random', [ApiProductController::class, 'random']);
    Route::get('/{id}', [ApiProductController::class, 'show']);
});

Route::group(['prefix' => 'orders'], function () {
    Route::get('/', [ApiOrderController::class, 'orders']);
    Route::get('/{id}', [ApiOrderController::class, 'show']);
    Route::post('/submit', [ApiOrderController::class, 'submit']);
});

Route::group(['prefix' => 'pre-order'], function () {
    Route::post('/submit', [ApiOrderController::class, 'preOrderSubmit']);
    Route::get('/{product_id}', [ApiOrderController::class, 'preOrder']);
});
