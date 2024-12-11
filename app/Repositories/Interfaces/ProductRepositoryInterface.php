<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function paginate(int $count, bool $isAvailable = true): LengthAwarePaginator;

    public function findRandom(int $count, bool $isAvailable = true): Collection;

    public function findById(int $id);

    public function ProductsInCart(array $select, $productIds);

    public function findWithSelect(array $select, int $id);
}
