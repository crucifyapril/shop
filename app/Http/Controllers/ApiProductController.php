<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    ) {
    }
    public function index(): JsonResponse
    {
        $products = $this->productService->getProductPaginated(15);

        return response()->json($products);
    }

    public function show(int $id): JsonResponse
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            return response()->json('Товар не найден', Response::HTTP_NOT_FOUND);
        }

        return response()->json($product);
    }

    public function random(): JsonResponse
    {
        $product = $this->productService->getRandomProduct(15);

        return response()->json($product);
    }
}
