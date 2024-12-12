<?php

namespace App\Providers;

use App\Services\Cart\Cart;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->app->singleton(Cart::class, function () {
            return new Cart();
        });
    }
}
