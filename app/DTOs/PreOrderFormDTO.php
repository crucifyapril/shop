<?php

namespace App\DTOs;

readonly class PreOrderFormDTO
{
    public function __construct(
        public string $email,
        public ?string $description,
        public int $product_id
    ) {
    }
}
