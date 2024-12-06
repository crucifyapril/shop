<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function orders(OrderService $orderService): View
    {
        $orders = $orderService->getOrdersPaginated(30);

        return view('orders.my-orders', compact('orders'));
    }

    public function show(int $id, OrderService $orderService): View
    {
        $order = $orderService->showOrder($id);

        return view('orders.order-show', $order);
    }

    public function create(): View
    {
        return view('orders.order-form');
    }

    public function submit(OrderService $orderService, OrderRequest $request): RedirectResponse
    {
        try {
            $orderService->createOrder($request->toDTO());
        } catch (Exception $e) {
            return redirect()->route('cart.index')->withErrors($e->getMessage());
        }

        return redirect()->route('orders');
    }
}
