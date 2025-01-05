<?php

namespace App\Dto;

readonly class RegisterFormDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {
    }
}
