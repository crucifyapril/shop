<?php

namespace App\Dto;

readonly class LoginFormData
{
    public function __construct(
        public string $email,
        public string $password
    ) {
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
