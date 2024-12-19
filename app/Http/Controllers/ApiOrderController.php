<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\PreOrderRequest;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\JsonResponse;

class ApiOrderController extends Controller
{
    public function orders(OrderService $orderService): JsonResponse
    {
        $orders = $orderService->getOrdersPaginated(30);

        return response()->json($orders);
    }

    public function show(int $id, OrderService $orderService): JsonResponse
    {
        $order = $orderService->showOrder($id);

        return response()->json($order);
    }

    public function submit(OrderService $orderService, OrderRequest $request): JsonResponse
    {
        try {
            $orderService->createOrder($request->toDTO());
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => 'Заказ успешно создан']);
    }

    public function preOrder($productId): JsonResponse
    {
        return response()->json(['message' => 'Подзаказ успешно создан']);
    }

    public function preOrderSubmit(OrderService $orderService, PreOrderRequest $request): JsonResponse
    {
        try {
            $orderService->preOrderMail($request->toDTO());
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => 'Подзаказ успешно отправлен']);
    }
}
