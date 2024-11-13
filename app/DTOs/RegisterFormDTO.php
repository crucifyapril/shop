<?php

namespace App\DTOs;

readonly class RegisterFormDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {
    }
}
