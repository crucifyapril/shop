<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Requests\ProductIdRequest;
use App\MoonShine\Resources\OrderResource;
use App\MoonShine\Resources\ProductResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;

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
        ];
    }

    protected function theme(): array
    {
        return [];
    }
}
