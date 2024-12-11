<?php

namespace App\Services;

use App\Enum\Statuses;
use App\Mail\ManagerNotification;
use App\Mail\OrderShipped;
use App\DTOs\OrderFormDTO;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\StatusRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Cart\CartService;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderService
{
    public function __construct(
        private CartService $cartService,
        protected readonly OrderRepositoryInterface $orderRepository,
        protected readonly UserRepositoryInterface $userRepository,
        protected readonly StatusRepositoryInterface $statusRepository,
        protected readonly RoleRepositoryInterface $RoleRepository,
        protected readonly ProductRepositoryInterface $productRepository
    ) {
    }

    /**
     * @throws Exception
     */
    public function createOrder(OrderFormDTO $orderDTO)
    {
        $user = $this->userRepository->findByEmail($orderDTO->email);
        $status = $this->statusRepository->findByName(Statuses::PENDING);

        $userId = null;
        if (!is_null($user)) {
            $userId = $user->id;
        }


        $cart = $this->cartService->get();
        if (empty($cart)) {
            throw new Exception('Cart is empty');
        }

        $productIds = array_keys($cart);
        $products = $this
            ->productRepository
            ->productsInCart(['id', 'price'], $productIds)
            ->map(function ($product) use ($cart) {
                $product->quantity = $cart[$product->id]['quantity'];

                return $product;
            });


        $totalAmount = $this->getSumTotal($products);

        DB::transaction(function () use ($orderDTO, $userId, $status, &$order, $cart, $totalAmount, $products) {
            $order = $this->orderRepository->create([
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
                $model = $this->productRepository->findWithSelect(['id', 'quantity', 'name'], $product->id);

                if ($model->quantity < $product->quantity) {
                    throw new Exception(
                        'Товар ' . $model->name . ' недостаточно на складе, в наличии ' . $model->quantity
                    );
                }

                $model->quantity -= $product->quantity;
                $model->save();
            }

            foreach ($this->RoleRepository->getManagerEmails() as $email) {
                Mail::to($email)->send(new ManagerNotification($order));
            }

            Mail::to($orderDTO->email)->send(new OrderShipped($order));

            $this->cartService->clear();
        });

        return $order;
    }


    public function getOrdersPaginated(int $count): LengthAwarePaginator
    {
        return $this->orderRepository->paginate($count);
    }

    public function showOrder(int $id): array
    {
        $order = $this->orderRepository->findOrderById($id);

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
