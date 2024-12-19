<?php

use App\Http\Controllers\ApiCartController;
use App\Http\Controllers\ApiProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ApiProductController::class)->only('index', 'show');
Route::apiResource('carts', ApiCartController::class)->only('index', 'store', 'destroy', 'clear');
