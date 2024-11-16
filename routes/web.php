<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/login', [AuthController::class, 'viewFormLogin'])->name('viewFormLogin');
Route::get('/register', [AuthController::class, 'viewFormRegister'])->name('viewFormRegister');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/orders', [OrderController::class, 'orders'])->middleware('auth')->name('orders');
Route::get('/order/form', [OrderController::class, 'create'])->name('order.create');
Route::post('/order/submit', [OrderController::class, 'submit'])->name('order.submit');
