<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Товары';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Имя', 'name')->sortable(),
                Text::make('Цена', 'price')->sortable(),
                Text::make('Описание', 'description')->sortable(),
                Text::make('Количество', 'quantity')->sortable(),
                Text::make('Статус', 'is_available')->sortable(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
