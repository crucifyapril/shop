<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\DTOs\OrderFormDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function createOrder(OrderFormDTO $orderDTO): Order
    {
        $user = User::query()->where('email', $orderDTO->email)->get('id')->first();

        if (!is_null($user)) {
            $userId = $user->id;
        }

        return Order::query()->create([
            'total_amount' => 1,
            'status' => 'pending',
            'user_id' => $userId ?? null,
            'phone' => $orderDTO->phone,
            'description' => $orderDTO->description,
            'product_id' => $orderDTO->product_id,
        ]);
    }

    public function getOrdersPaginated(int $count): LengthAwarePaginator
    {
        return Order::query()->where('user_id', Auth::user()->id)->paginate($count);
    }
}
