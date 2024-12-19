<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(
        protected readonly ProductRepository $productRepository
    ) {
    }

    public function index(): JsonResponse
    {
        $products = $this->productRepository->getAll();
        return response()->json($products);
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $product = $this->productRepository->create($request->validated());

        return response()->json($product, 201);
    }

    public function show($id): JsonResponse
    {
        $product = $this->productRepository->findById($id);
        return response()->json($product);
    }

    public function update(ProductRequest $request, $id): JsonResponse
    {
        $product = $this->productRepository->findById($id);

        $updatedProduct = $this->productRepository->update($product, $request->validated());

        return response()->json($updatedProduct);
    }

    public function destroy($id): JsonResponse
    {
        $product = $this->productRepository->findById($id);
        $this->productRepository->delete($product);

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
