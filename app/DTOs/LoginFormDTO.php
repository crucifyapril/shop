<?php

namespace App\DTOs;

readonly class LoginFormDTO
{
    public function __construct(
        public string $email,
        public string $password
    ) {
    }
}
