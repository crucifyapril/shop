<?php

namespace App\Providers;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\StatusRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\RoleRepository;
use App\Repositories\StatusRepository;
use App\Repositories\UserRepository;
use App\Services\Cart\Cart;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(StatusRepositoryInterface::class, StatusRepository::class);
    }

    public function boot(): void
    {
        $this->app->singleton(Cart::class, function () {
            return new Cart();
        });
    }
}
