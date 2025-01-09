<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductShowRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function index(ProductService $productService): View
    {
        $products = $productService->getProductPaginated(15);

        return view('products.index', compact('products'));
    }

    public function show(int $id, productService $productService): RedirectResponse|View
    {
        $product = $productService->getProductById($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Товар не найден');
        }

        return view('products.show', compact('product'));
    }
}
