<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct(protected readonly ProductRepository $productRepository)
    {
    }

    public function getProductPaginated(int $count, bool $isAvailable = true): LengthAwarePaginator
    {
        return $this->productRepository->paginate($count, $isAvailable);
    }

    public function getRandomProduct(int $count, bool $isAvailable = true): Collection
    {
        return $this->productRepository->findRandom($count, $isAvailable);
    }

    public function getProductById(int $id)
    {
        return $this->productRepository->findById($id);
    }
}
