<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\ProductIdRequest;
use App\Services\OrderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function orders(OrderService $orderService): View
    {
        $orders = $orderService->showOrders();
        $paginate = $orderService->getOrdersPaginated(10);

        return view('orders.my-orders', compact('orders', 'paginate'));
    }

    public function create(ProductIdRequest $request): View
    {
        return view('orders.order-form', ['product_id' => $request->input('product_id')]);
    }

    public function submit(OrderService $orderService, OrderRequest $request): RedirectResponse
    {
        $orderService->createOrder($request->toDTO());

        return redirect()->route('orders');
    }
}
