<?php

namespace App\Repositories;

use App\Enum\Roles;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function findByName(Roles $name)
    {
        return Role::query()->where('name', $name)->first();
    }

    public function getManagerEmails(): array
    {
        return User::query()
            ->whereHas('role', fn($query) => $query->where('name', Roles::MANAGER))
            ->pluck('email')
            ->toArray();
    }
}
