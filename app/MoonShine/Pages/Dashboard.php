<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use MoonShine\Decorations\Grid;
use MoonShine\Metrics\ValueMetric;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;

class Dashboard extends Page
{
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Dashboard';
    }

    public function components(): array
    {
        return [
            Grid::make([
                ValueMetric::make('Заказы')
                    ->value(Order::query()->count())
                    ->icon('heroicons.shopping-bag')
                    ->columnSpan(4),
                ValueMetric::make('Товары')
                    ->value(Product::query()->count())
                    ->icon('heroicons.shopping-bag')
                    ->columnSpan(4),
                ValueMetric::make('Покупатели')
                    ->value(User::query()->has('orders')->count('id'))
                    ->icon('heroicons.users')
                    ->columnSpan(4)
            ])
        ];
    }
}
