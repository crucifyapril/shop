<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request): View
    {

        return view('Orders.order-form', ['product_id' => $request->input('product_id')]);
    }

    public function submit(OrderService $orderService, OrderRequest $request): RedirectResponse
    {
        $orderService->createOrder($request->toDTO());

        return redirect()->route('index');
    }
}
