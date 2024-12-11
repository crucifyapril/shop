<?php

namespace App\Repositories\Interfaces;

use App\Enum\Roles;

interface RoleRepositoryInterface
{
    public function findByName(Roles $name);

    public function getManagerEmails(): array;
}
