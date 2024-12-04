<?php

namespace App\Services\Cart;

use Exception;

class Cart
{
    private array $items = [];

    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @throws Exception
     */
    public function addItem(int $id, array $data): void
    {
        if (isset($this->items[$id])) {
            $this->updateItem($id, $data);
            return;
        }

        $this->items[$id] = $data;
    }

    /**
     * @throws Exception
     */
    public function updateItem(int $id, array $data): void
    {
        if (!isset($this->items[$id])) {
            throw new Exception('Item not found');
        }

        $this->items[$id]['quantity'] += $data['quantity'];
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
