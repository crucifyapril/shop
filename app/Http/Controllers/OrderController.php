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
    public function __construct(
        private readonly OrderService $orderService
    ) {
    }

    public function orders(): View
    {
        $orders = $this->orderService->getOrdersPaginated(30);

        return view('orders.my-orders', compact('orders'));
    }

    public function show(int $id): View
    {
        $order = $this->orderService->showOrder($id);

        return view('orders.order-show', $order);
    }

    public function create(): View
    {
        return view('orders.order-form');
    }

    public function submit(OrderRequest $request): RedirectResponse
    {
        try {
            $this->orderService->createOrder($request->orderFormDto());
        } catch (Exception $e) {
            return redirect()->route('cart.index')->withErrors($e->getMessage());
        }

        return redirect()->route('orders');
    }

    public function preOrder($productId)
    {
        return view('orders.pre-order', ['productId' => $productId]);
    }

    public function preOrderSubmit(PreOrderRequest $request): RedirectResponse
    {
        try {
            $this->orderService->preOrderMail($request->preOrderFormDto());
        } catch (Exception $e) {
            return redirect()->route('index')->withErrors($e->getMessage());
        }

        return redirect()->route('index');
    }
}
