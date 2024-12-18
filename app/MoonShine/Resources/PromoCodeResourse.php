<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\PromoCode;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\Date;
use MoonShine\Fields\DateRange;
use MoonShine\Fields\Number;
use MoonShine\Fields\Range;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use Ramsey\Uuid\Type\Integer;

class PromoCodeResourse extends ModelResource
{
    protected string $model = PromoCode::class;

    protected string $title = 'Заказы';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Промокод', 'code')->sortable(),
                Number::make('Скидка', 'discount')->sortable(),
                Date::make('Заканчивается', 'expires_at')->sortable(),
                Text::make('Создан', 'created_at')->sortable(),
                Text::make('Обновлен', 'updated_at')->hideOnCreate()->hideOnUpdate(),
            ]),
        ];
    }

    public function filters(): array
    {
        return [
            Number::make('ID', 'id'),
            Text::make('Промокод', 'code'),
            Number::make('Скидка', 'discount'),
            Date::make('Заканчивается', 'expires_at'),
            DateRange::make('Дата создания', 'created_at')
                ->fromTo('date_from', 'date_to'),
            DateRange::make('Дата обновления', 'updated_at')
                ->fromTo('date_from', 'date_to')
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'promo_code' => ['nullable', 'string', 'max:255'],
        ];
    }
}
