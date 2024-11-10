<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/login', [AuthController::class, 'viewFormLogin'])->name('viewFormLogin');
Route::get('/register', [AuthController::class, 'viewFormRegister'])->name('viewFormRegister');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
