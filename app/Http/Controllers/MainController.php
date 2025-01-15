<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\View\View;

class MainController
{
    public function __construct(
        private readonly ProductService $productService
    ) {
    }

    public function index(): View
    {
        $products = $this->productService->getRandomProduct(5);

        return view('index', compact('products'));
    }
}
