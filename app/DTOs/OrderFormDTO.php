<?php

namespace App\DTOs;

readonly class OrderFormDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public ?string $description,
        public int $product_id
    ) {
    }
}
