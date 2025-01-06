<?php

namespace App\Dto;

readonly class PreOrderFormDto
{
    public function __construct(
        public string $email,
        public ?string $description,
        public int $product_id
    ) {
    }
}
