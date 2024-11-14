<?php

namespace App\DTOs;

readonly class OrderFormDTO
{
    public function __construct(
        public string $name,
        public string $phone,
        public ?string $comment,
        public int $product_id
    ) {
    }
}
