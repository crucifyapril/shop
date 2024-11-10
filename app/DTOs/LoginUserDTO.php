<?php

namespace App\DTOs;

readonly class LoginUserDTO
{
    public function __construct(
        public string $email,
        public string $password
    ) {}
}
