<?php

namespace App\Repositories\Interfaces;

interface StatusRepositoryInterface
{
    public function findByName(string $name);
}
