<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

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
            return response()->json('Товар не найден', 404);
        }

        return response()->json($product);
    }
}
