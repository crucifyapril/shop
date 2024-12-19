<?php

use App\Http\Controllers\ApiOrderController;
use App\Http\Controllers\ApiProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ApiProductController::class)->only('index', 'show');
Route::get('/orders', [ApiOrderController::class, 'orders']);
Route::get('/order/{id}', [ApiOrderController::class, 'show']);
Route::post('/order/submit', [ApiOrderController::class, 'submit']);
Route::get('/pre-order/{product_id}', [ApiOrderController::class, 'preOrder']);
Route::post('/pre-order/submit', [ApiOrderController::class, 'preOrderSubmit']);
