<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use MoonShine\Fields\DateRange;
use MoonShine\Fields\Number;
use MoonShine\Fields\Range;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class OrderResource extends ModelResource
{
    protected string $model = Order::class;

    protected string $title = 'Заказы';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Статус', 'status.name')->sortable(),
                Text::make('Заказчик', 'user.name')->sortable(),
                Text::make('Сумма', 'total_amount')->sortable(),
                Text::make('Дата создания', 'created_at')->sortable(),
                Text::make('Комментарий', 'description')->sortable(),
            ]),
        ];
    }

    public function filters(): array
    {
        return [
            Number::make('ID', 'id'),
            Select::make('Статус', 'Status_id')
                ->options(fn() => Status::all()->pluck('name', 'id')->toArray()),
            Range::make('Сумма', 'total_amount'),
            DateRange::make('Дата создания', 'created_at')
                ->fromTo('date_from', 'date_to'),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
