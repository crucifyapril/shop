<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\Manager;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
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
Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
Route::get('/pre-order/{product_id}', [OrderController::class, 'preOrder'])->name('order.pre-order');
Route::post('/pre-order/submit', [OrderController::class, 'preOrderSubmit'])->name('order.pre-order.submit');

Route::group(['prefix' => 'admin1', 'middleware' => [Manager::class]], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // Получить содержимое корзины
Route::post('/cart', [CartController::class, 'store'])->name('cart.store'); // Добавить товар в корзину
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update'); // Обновить товар в корзине
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy'); // Удалить конкретный товар
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear'); // Очистить всю корзину
