<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class FavoriteService
{
    public function paginate(int $count)
    {
        return auth()->user()->favorites()->paginate($count);
    }

    public function addToFavorite(Authenticatable $user, Product $product)
    {
        if ($user->favorites()->where('product_id', $product->id)->exists()) {
            $user->favorites()->detach($product->id);
            return 'Товар удалён из избранного.';
        }

        $user->favorites()->attach($product->id);
        return 'Товар добавлен в избранное.';
    }
}
