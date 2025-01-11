<?php

namespace App\Services\Cart;

use App\Exceptions\ProductOutOfStockException;
use App\Repositories\ProductRepository;
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
        private readonly Cart $cart,
        private readonly ProductRepository $productRepository
    ) {
        $this->connection = Redis::connection('cart');
        $this->get();
    }

    /**
     * Получение корзины из хранилища
     */
    public function get(): array
    {
        $data = $this->connection->get($this->getKey());
        $this->cart->load($data ?? '{}');

        return $this->cart->getItems();
    }

    public function getProducts()
    {
        $cart = $this->get();

        $products = $this->productRepository->productsInCart(['id', 'name', 'price'], array_keys($cart));

        return $products->map(function ($product) use ($cart) {
            return array_merge($product->toArray(), $cart[$product->id]);
        });
    }

    /**
     * @throws Exception
     */
    public function addItem(int $id, array $data): bool
    {
        $product = $this->productRepository->findById($id);

        $currentQuantityInCart = $this->cart->getItem($id)['quantity'] ?? 0;

        $quantityToAdd = $data['quantity'] ?? 0;

        $newQuantity = $currentQuantityInCart + $quantityToAdd;

        if ($quantityToAdd < 0) {
            $this->cart->updateItem($id, ['quantity' => $quantityToAdd]);
            return $this->save();
        }

        if ($product->quantity < $newQuantity) {
            throw new ProductOutOfStockException();
        }

        $this->cart->addItem($id, ['quantity' => $quantityToAdd]);

        return $this->save();
    }

    public function removeItem(int $id): bool
    {
        $this->cart->removeItem($id);

        return $this->save();
    }

    public function clear(): bool
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
