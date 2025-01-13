<?php

namespace App\Dto;

readonly class OrderFormDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public ?string $description,
        public ?string $promoCode
    ) {
    }
}
