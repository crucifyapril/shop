<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\PreOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Throwable;
use Symfony\Component\HttpFoundation\Response;

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
            return response()->json(['message' => 'Такого заказа не существует'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($order);
    }

    public function submit(OrderService $orderService, OrderRequest $request): JsonResponse
    {
        try {
            $orderService->createOrder($request->toDto());
        } catch (Throwable) {
            return response()->json(['message' => 'Произошла ошибка при создании заказа'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['message' => 'Заказ успешно создан']);
    }

    public function preOrderSubmit(OrderService $orderService, PreOrderRequest $request): JsonResponse
    {
        try {
            $orderService->preOrderMail($request->toDto());
        } catch (Throwable) {
            return response()->json(['message' => 'Произошла ошибка при отправке подзаказа'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['message' => 'Подзаказ успешно отправлен']);
    }
}
