<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\PreOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Throwable;

class ApiOrderController extends Controller
{
    public function orders(OrderService $orderService): JsonResponse
    {
        $orders = $orderService->getOrdersPaginated(30);

        return response()->json($orders);
    }

    public function show(int $id, OrderService $orderService): JsonResponse
    {
        try {
            $order = $orderService->showOrder($id);
        } catch (Throwable) {
            return response()->json(['message' => 'Такого заказа не существует'], 404);
        }

        return response()->json($order);
    }

    public function submit(OrderService $orderService, OrderRequest $request): JsonResponse
    {
        try {
            $orderService->createOrder($request->toDTO());
        } catch (Throwable) {
            return response()->json(['message' => 'Произошла ошибка при создании заказа'], 400);
        }

        return response()->json(['message' => 'Заказ успешно создан']);
    }

    public function preOrderSubmit(OrderService $orderService, PreOrderRequest $request): JsonResponse
    {
        try {
            $orderService->preOrderMail($request->toDTO());
        } catch (Throwable) {
            return response()->json(['message' => 'Произошла ошибка при отправке подзаказа'], 400);
        }

        return response()->json(['message' => 'Подзаказ успешно отправлен']);
    }
}
