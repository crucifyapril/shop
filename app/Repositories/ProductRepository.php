<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    public function paginate(int $count, bool $isAvailable = true): LengthAwarePaginator
    {
        return Product::query()
            ->where('is_available', $isAvailable)
            ->paginate($count);
    }

    public function findRandom(int $count, bool $isAvailable = true): Collection
    {
        return Product::query()
            ->inRandomOrder()
            ->limit($count)
            ->where('is_available', $isAvailable)
            ->get();
    }

    public function findById(int $id)
    {
        return Product::query()->find($id);
    }

    public function productsInCart(array $select, $productIds): Collection
    {
        return Product::query()
            ->select($select)
            ->whereIn('id', $productIds)
            ->get();
    }

    public function findWithSelect(array $select, int $id)
    {
        return Product::query()->select($select)->find($id);
    }
}
