<?php

namespace App\Services;

use App\Enum\Statuses;
use App\Models\Status;
use App\Models\User;
use App\Models\Order;
use App\DTOs\OrderFormDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createOrder(OrderFormDTO $orderDTO): Order
    {
        $user = User::query()->where('email', $orderDTO->email)->get('id')->first();
        $status = Status::query()->where('name', Statuses::PENDING)->first();

        $userId = null;
        if (!is_null($user)) {
            $userId = $user->id;
        }

        DB::transaction(function () use ($orderDTO, $userId, $status, &$order) {
            $order = Order::query()->create([
                'total_amount' => 1,
                'status_id' => $status->id,
                'user_id' => $userId,
                'phone' => $orderDTO->phone,
                'description' => $orderDTO->description,
            ]);

            $order->products()->attach($orderDTO->product_id);
        });

        return $order;
    }

    public function getOrdersPaginated(int $count): LengthAwarePaginator
    {
        return Order::query()->where('user_id', auth()->id())->paginate($count);
    }

    public function showOrder(int $id): array
    {
        $order =  Order::query()->select(['id', 'description', 'total_amount', 'status_id'])->with(['status'])->where('user_id', auth()->id())->find($id);
        $products = $order->products()->select(['products.id', 'name', 'price'])->get();

        return [
            'id' => $order->id,
            'description' => $order->description,
            'products' => $products,
            'status' => $order->status->name,
            'total_amount' => $order->total_amount
        ];
    }
}
