<?php

namespace App\Repositories;

use App\Enum\Statuses;
use App\Models\Status;
use App\Repositories\Interfaces\StatusRepositoryInterface;

class StatusRepository implements StatusRepositoryInterface
{
    public function findByName(Statuses|string $name)
    {
        return Status::query()->where('name', $name)->first();
    }
}
