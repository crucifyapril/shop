<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use MoonShine\Fields\DateRange;
use MoonShine\Fields\Email;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Пользователи';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Имя', 'name')->sortable(),
                Text::make('Email', 'email')->sortable(),
                Text::make('Пароль', 'password')->hideOnIndex()->hideOnCreate()->hideOnUpdate(),
                Number::make('Роль', 'role_id')->hideOnIndex()->hideOnCreate()->hideOnUpdate(),
                Text::make('Создан', 'created_at')->sortable(),
                Text::make('Обновлен', 'updated_at')->hideOnCreate()->hideOnUpdate(),
            ]),
        ];
    }

    public function filters(): array
    {
        return [
            Text::make('ID', 'id'),
            Text::make('Имя', 'name'),
            Text::make('Email', 'email'),
            Number::make('Роль', 'role_id'),
            DateRange::make('Дата создания', 'created_at')
                ->fromTo('date_from', 'date_to'),
            DateRange::make('Дата обновления', 'updated_at')
                ->fromTo('date_from', 'date_to')
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
