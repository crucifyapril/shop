<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;

class MainController
{
    public function index(): View
    {
        $products = Product::query()->inRandomOrder()->limit(5)->get();

        return view('index', compact('products'));
    }
}
