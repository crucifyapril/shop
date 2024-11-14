<?php

namespace App\Services;

use App\DTOs\OrderFormDTO;
use App\Models\Order;
use Illuminate\Http\Request;


class OrderService
{
    public function createOrder(OrderFormDTO $dto): Order
    {

        return Order::query()->create([
            'total_amount' => 1,
            'status' => 'pending',
            'name' => $dto->name,
            'phone' => $dto->phone,
            'comment' => $dto->comment,
            'product_id' => $dto->product_id,
            'description' => 'Описание заказа',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
