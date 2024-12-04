@extends('base')

@section('header')
    @include('components.header')
@endsection


@section('content')
    <div class="bg-gray-100 dark:bg-gray-800 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex md:flex-row items-center">
                <div class="md:flex-1 w-1/2 h-1/2 px-4 mb-4 md:mb-0 flex">
                    <div class="w-full h-full rounded-lg bg-gray-300 dark:bg-gray-700 overflow-hidden">
                        <img class="w-full h-full object-cover" src="{{ asset('images/no-image.jpg') }}"
                             alt="Product Image">
                    </div>
                </div>
                <div class="md:flex-1 px-4">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">{{ $product->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-6">
                        Описание: {{ $product->description }}
                    </p>
                    <div class="flex mb-6">
                        <div class="mr-6">
                            <span class="font-semibold text-gray-700 dark:text-gray-300">Цена:</span>
                            <span class="text-lg text-gray-600 dark:text-gray-300">{{ $product->price }} руб</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-700 dark:text-gray-300">Товар:</span>
                            <span
                                class="text-gray-600 dark:text-gray-300">{{ $product->is_available ? 'В наличии' : 'Нет в наличии' }}</span>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 px-2">
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit"
                                class="w-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-2 px-4 rounded-full font-bold hover:bg-gray-300 dark:hover:bg-gray-600">
                            Добавить в корзину
                        </button>
                    </form>
                </div>
                <div class="w-1/2 px-2"><a href="{{ route('order.create', ['product_id' => $product->id]) }}">
                        <button
                            class="w-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-2 px-4 rounded-full font-bold hover:bg-gray-300 dark:hover:bg-gray-600">
                            Купить
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection
