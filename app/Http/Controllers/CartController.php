<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Cart\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cartService
    ) {
    }

    public function index(): View
    {
        $cart = $this->cartService->get();

        $products = Product::query()
            ->select(['id', 'name', 'price'])
            ->whereIn('id', array_keys($cart))
            ->get();

        $products = $products->map(function ($product) use ($cart) {
            return array_merge($product->toArray(), $cart[$product->id]);
        });

        return view('cart.index', ['cart' => $products]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->cartService->addItem(
            $request->get('product_id'),
            ['quantity' => $request->get('quantity')]
        );

        return redirect()->route('cart.index');
    }

    public function update(): JsonResponse
    {
        return response()->json(['message' => 'обновить товар в корзине']);
    }

    public function destroy(): JsonResponse
    {
        return response()->json(['message' => 'удалить конкретный товар']);
    }

    public function clear(): RedirectResponse
    {
        $this->cartService->clear();

        return redirect()->route('cart.index');
    }
}
