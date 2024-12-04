<?php

namespace App\Http\Controllers;

use App\Services\Cart\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(CartService $cart): View
    {
        return view('cart.index', $cart->get());
    }

    public function store(CartService $cartService, Request $request): View
    {
        $cartService->addItem($request->get('product_id'), ['quantity' => $request->get('quantity')]);

        return view('cart.index', $cartService->get());
    }

    public function update(): JsonResponse
    {
        return response()->json(['message' => 'обновить товар в корзине']);
    }

    public function destroy(): JsonResponse
    {
        return response()->json(['message' => 'удалить конкретный товар']);
    }

    public function clear(): JsonResponse
    {
        return response()->json(['message' => 'очистить всю корзину']);
    }
}
