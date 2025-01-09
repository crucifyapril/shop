<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\View\View;

class MainController
{
    public function index(ProductService $productService): View
    {
        $products = $productService->getRandomProduct(5);

        return view('index', compact('products'));
    }
}
