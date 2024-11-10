<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function index(ProductService $productService): View
    {
        $products = $productService->getProductPaginated(15);

        return view('products.index', compact('products'));
    }
}
