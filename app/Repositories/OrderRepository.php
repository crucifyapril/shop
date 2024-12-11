<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $data)
    {
        return Order::query()->create($data);
    }

    public function paginate(int $count): LengthAwarePaginator
    {
        return Order::query()->where('user_id', auth()->id())->paginate($count);
    }

    public function findOrderById(int $id)
    {
        return Order::query()->select(['id', 'description', 'total_amount', 'status_id'])->with(['status'])->where(
            'user_id',
            auth()->id()
        )->find($id);
    }
}
