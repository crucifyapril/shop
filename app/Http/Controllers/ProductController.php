<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductShowRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    ) {
    }

    public function index(): View
    {
        $products = $this->productService->getProductPaginated(15);

        return view('products.index', compact('products'));
    }

    public function show(ProductShowRequest $request): RedirectResponse|View
    {
        $product = $this->productService->getProductById($request->get('id'));

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Товар не найден');
        }

        return view('products.show', compact('product'));
    }
}
