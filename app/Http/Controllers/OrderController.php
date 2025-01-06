<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\PreOrderRequest;
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
            $orderService->createOrder($request->toDto());
        } catch (Exception $e) {
            return redirect()->route('cart.index')->withErrors($e->getMessage());
        }

        return redirect()->route('orders');
    }

    public function preOrder($productId)
    {
        return view('orders.pre-order', ['productId' => $productId]);
    }

    public function preOrderSubmit(OrderService $orderService, PreOrderRequest $request): RedirectResponse
    {
        try {
            $orderService->preOrderMail($request->toDto());
        } catch (Exception $e) {
            return redirect()->route('index')->withErrors($e->getMessage());
        }

        return redirect()->route('index');
    }
}
