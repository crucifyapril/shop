<div class="flex flex-wrap justify-center">
    @foreach($products as $product)
        <div
            class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 m-2">
            <a href="{{ route('products.show', ['id' => $product->id]) }}">
                <img class="p-8 rounded-t-lg" src="{{ asset('images/no-image.jpg') }}" alt="product image" />
            </a>
            <div class="px-5 pb-5">
                <a href="{{ route('products.show', ['id' => $product->id]) }}">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $product->name }}</h5>
                </a>
                <div class="flex items-center justify-between">
                    <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ $product->price }} руб.</span>
                    @if($product->quantity === 0)
                        <form action="{{ route('order.pre-order', ['product_id' => $product->id]) }}">
                            @csrf
                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                       dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Под заказ</button>
                        </form>
                    @else
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                       dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">В корзину</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
