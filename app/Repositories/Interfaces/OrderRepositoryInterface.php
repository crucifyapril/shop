<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function create(array $data);

    public function paginate(int $count);

    public function findOrderById(int $id);
}
