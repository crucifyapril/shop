<?php

namespace App\Services\Cart;

use Exception;
use Illuminate\Redis\Connections\Connection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class CartService
{
    private Connection $connection;

    public function __construct(
        private readonly Cart $cart
    ) {
        $this->connection = Redis::connection('cart');
        $this->get();
    }

    public function get(): array
    {
        $data = $this->connection->get($this->getKey());
        $this->cart->load($data ?? '{}');

        return $this->cart->toArray();
    }

    /**
     * @throws Exception
     */
    public function addItem(int $id, array $data): bool
    {
        $this->cart->addItem($id, $data);

        return $this->save();
    }

    public function removeItem()
    {
    }

    public function clear()
    {
        $this->cart->clear();

        return $this->save();
    }

    private function generateKey(): string
    {
        $uuid = (string)Str::uuid();
        if (Auth::check()) {
            $uuid = $uuid . '-' . Auth::id();
        }

        return $uuid;
    }

    private function getKey(): array|string|null
    {
        $cartId = Cookie::get('cartId');

        if (is_null($cartId)) {
            $cartId = $this->generateKey();
            Cookie::queue(Cookie::make('cartId', $cartId, 60 * 60 * 24 * 7));
        }

        return $cartId;
    }

    private function save(): bool
    {
        return $this->connection->set($this->getKey(), $this->cart->toJson(), expireTTL: 60 * 60 * 24 * 7);
    }
}
