<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminService
{
    public function getStat(): array
    {
        return [
            'users' => User::query()->count(),
            'orders' => Order::query()->count(),
            'products' => Product::query()->count(),
        ];
    }
}
