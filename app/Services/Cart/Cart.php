<?php

namespace App\Services\Cart;

class Cart
{
    private array $items = [];

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(int $id, array $data): void
    {
        $this->items[$id] = $data;
    }

    public function updateItem(int $id, array $data): void
    {
        $this->items[$id] = $data;
    }

    public function removeItem(int $id): void
    {
        unset($this->items[$id]);
    }

    public function clear(): void
    {
        $this->items = [];
    }

    public function toJson(): string
    {
        return json_encode($this->items, JSON_FORCE_OBJECT);
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function init(string $data): void
    {
        if (empty($data)) {
            return;
        }

        $this->items = json_decode($data, true);
    }

    public function load(string $data): void
    {
        $this->items = json_decode($data, true);
    }
}
