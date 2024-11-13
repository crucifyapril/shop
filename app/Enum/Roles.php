<?php

namespace App\Enum;

enum Roles: string
{
    case BUYER = 'buyer';
    case MANAGER = 'manager';
    case OWNER = 'owner';
}
