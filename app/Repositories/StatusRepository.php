<?php

namespace App\Repositories;

use App\Enum\Statuses;
use App\Models\Status;

class StatusRepository
{
    public function findByName(Statuses|string $name)
    {
        return Status::query()->where('name', $name)->first();
    }
}
