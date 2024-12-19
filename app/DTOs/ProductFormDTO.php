<?php

namespace App\DTOs;

readonly class ProductFormDTO
{
    public function __construct(
        public string $name,
        public int $price,
        public ?string $description,
        public int $quantity,
        public bool $is_available
    ) {
    }
}
