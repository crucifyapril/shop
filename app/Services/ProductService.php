<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService
{
    public function getProductPaginated(int $count, bool $isAvailable = true): LengthAwarePaginator
    {
        return Product::query()
            ->where('is_available', $isAvailable)
            ->paginate($count);
    }

    public function getRandomProduct(int $count, bool $isAvailable = true): Collection
    {
        return Product::query()
            ->inRandomOrder()
            ->limit($count)
            ->where('is_available', $isAvailable)
            ->get();
    }
}
