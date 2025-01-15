<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CartStoreRequest;
use App\Services\Cart\CartService;
use Illuminate\Http\JsonResponse;

class ApiCartController extends Controller
{
    public function __construct(
        private readonly CartService $cartService
    ) {
    }

    public function index(): JsonResponse
    {
        $products = $this->cartService->getProducts();

        return response()->json($products);
    }

    /**
     * @throws \Exception
     */
    public function store(CartStoreRequest $request): JsonResponse
    {
        $this->cartService->addItem(
            (int)$request->get('product_id'),
            ['quantity' => $request->get('quantity')]
        );

        return response()->json($request);
    }

    public function update(): JsonResponse
    {
        return response()->json(['message' => 'обновить товар в корзине']);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->cartService->removeItem($id);

        return response()->json(['Товар удален из корзины']);
    }

    public function clear(): JsonResponse
    {
        $this->cartService->clear();

        return response()->json(['Корзина очищена']);
    }
}
