<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiProductController extends Controller
{
    public function index(ProductService $productService): JsonResponse
    {
        $products = $productService->getProductPaginated(15);

        return response()->json($products);
    }

    public function show(int $id, productService $productService): JsonResponse
    {
        $product = $productService->getProductById($id);

        if (!$product) {
            return response()->json('Товар не найден', Response::HTTP_NOT_FOUND);
        }

        return response()->json($product);
    }

    public function random(ProductService $productService): JsonResponse
    {
        $product = $productService->getRandomProduct(15);

        return response()->json($product);
    }
}
