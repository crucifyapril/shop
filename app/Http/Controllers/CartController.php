<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CartStoreRequest;
use App\Models\Product;
use App\Services\Cart\CartService;
use Exception;
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
        $products = $this->cartService->getProducts();

        return view('cart.index', ['products' => $products]);
    }

    /**
     * @throws Exception
     */
    public function store(CartStoreRequest $request): RedirectResponse
    {
        try {
            $this->cartService->addItem(
                (int)$request->get('product_id'),
                ['quantity' => $request->get('quantity')]
            );
        } catch (Exception $exception) {
            return redirect()
                ->route('cart.index')
                ->withErrors(['custom_error' => $exception->getMessage()]);
        }

        return redirect()->route('cart.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->cartService->removeItem($id);

        return redirect()->route('cart.index');
    }

    public function clear(): RedirectResponse
    {
        $this->cartService->clear();

        return redirect()->route('cart.index');
    }
}
