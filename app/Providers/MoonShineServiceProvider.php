<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\OrderResource;
use App\MoonShine\Resources\ProductResource;
use App\MoonShine\Resources\PromoCodeResourse;
use App\MoonShine\Resources\UserResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Menu\MenuItem;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [
            new OrderResource(),
        ];
    }

    protected function pages(): array
    {
        return [];
    }

    protected function menu(): array
    {
        return [
            MenuItem::make('На сайт', 'http://localhost')
                ->badge(fn() => 'Check'),
            MenuItem::make('Заказы', new OrderResource()),
            MenuItem::make('Товары', new ProductResource()),
            MenuItem::make('Пользователи', new UserResource()),
            MenuItem::make('Промокоды', new PromoCodeResourse()),
        ];
    }

    protected function theme(): array
    {
        return [];
    }
}
