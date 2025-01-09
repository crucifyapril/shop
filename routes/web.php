<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;

Route::get('/', [MainController::class, 'index'])->name('index');

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{id}', [ProductController::class, 'show'])->name('products.show')->whereNumber('id');
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', [AuthController::class, 'viewFormLogin'])->name('viewFormLogin');
    Route::get('/register', [AuthController::class, 'viewFormRegister'])->name('viewFormRegister');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
});

Route::group(['prefix' => 'orders'], function () {
    Route::get('/', [OrderController::class, 'orders'])->middleware('auth')->name('orders');
    Route::get('/form', [OrderController::class, 'create'])->name('order.create');
    Route::post('/submit', [OrderController::class, 'submit'])->name('order.submit');
    Route::get('/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/form/apply-promo', [OrderController::class, 'applyPromo'])->name('order.apply-promo');
});

Route::group(['prefix' => 'pre-order'], function () {
    Route::get('/{product_id}', [OrderController::class, 'preOrder'])->name('order.pre-order');
    Route::post('/submit', [OrderController::class, 'preOrderSubmit'])->name('order.pre-order.submit');
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index'); // Получить содержимое корзины
    Route::post('/', [CartController::class, 'store'])->name('cart.store'); // Добавить товар в корзину
    Route::put('/{id}', [CartController::class, 'update'])->name('cart.update'); // Обновить товар в корзине
    Route::delete('/{id}', [CartController::class, 'destroy'])->name('cart.destroy'); // Удалить конкретный товар
    Route::delete('/', [CartController::class, 'clear'])->name('cart.clear'); // Очистить всю корзину
});

Route::group(['prefix' => 'favorites'], function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->middleware('auth')->name('favorites.index');
    Route::post('/favorites/toggle/{product}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});
