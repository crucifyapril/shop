<?php

namespace App\Services;

use App\Enum\Statuses;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use App\Models\Order;
use App\DTOs\OrderFormDTO;
use App\Services\Cart\CartService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderService
{
    public function __construct(
        private CartService $cartService
    ) {
    }

    /**
     * @throws Exception
     */
    public function createOrder(OrderFormDTO $orderDTO): Order
    {
        $user = User::query()->where('email', $orderDTO->email)->get('id')->first();
        $status = Status::query()->where('name', Statuses::PENDING)->first();

        $userId = null;
        if (!is_null($user)) {
            $userId = $user->id;
        }


        $cart = $this->cartService->get();
        if (empty($cart)) {
            throw new Exception('Cart is empty');
        }

        $productIds = array_keys($cart);
        $products = Product::query()
            ->select(['id', 'price'])
            ->whereIn('id', $productIds)
            ->get()
            ->map(function ($product) use ($cart) {
                $product->quantity = $cart[$product->id]['quantity'];

                return $product;
            });


        $totalAmount = $this->getSumTotal($products);

        DB::transaction(function () use ($orderDTO, $userId, $status, &$order, $cart, $totalAmount, $products) {
            $order = Order::query()->create([
                'total_amount' => $totalAmount,
                'status_id' => $status->id,
                'user_id' => $userId,
                'phone' => $orderDTO->phone,
                'description' => $orderDTO->description,
            ]);

            foreach ($products as $product) {
                $order->products()->attach($product->id, ['quantity' => $product->quantity]);
            }

            foreach ($products as $product) {
                $model = Product::query()->select(['id', 'quantity', 'name'])->find($product->id);

                if ($model->quantity < $product->quantity) {
                    throw new Exception('Товар ' . $model->name . ' недостаточно на складе, в наличии ' . $model->quantity);
                }

                $model->quantity -= $product->quantity;
                $model->save();
            }



            Mail::raw('Order created', function ($message) use ($order) {
                $message->to('danilpatuk@yandex.ru')->subject('Order created');
            });

            $this->cartService->clear();
        });

        return $order;
    }


    public function getOrdersPaginated(int $count): LengthAwarePaginator
    {
        return Order::query()->where('user_id', auth()->id())->paginate($count);
    }

    public function showOrder(int $id): array
    {
        $order = Order::query()->select(['id', 'description', 'total_amount', 'status_id'])->with(['status'])->where(
            'user_id',
            auth()->id()
        )->find($id);

        $products = $order->products()->select(['products.id', 'products.name', 'products.price'])->withPivot(
            'quantity'
        )->get();

        return [
            'id' => $order->id,
            'description' => $order->description,
            'products' => $products,
            'status' => $order->status->name,
            'total_amount' => $order->total_amount
        ];
    }

    private function getSumTotal($products): int
    {
        $totalAmount = 0;
        foreach ($products as $product) {
            $totalAmount += $product->price * $product->quantity;
        }

        return $totalAmount;
    }
}
