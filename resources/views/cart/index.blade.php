@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1 class="text-3xl font-bold flex items-center justify-center mb-16 mt-10">Корзина</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Ошибка:</strong>
            <span class="block sm:inline">{{ $errors->first() }}</span>
        </div>
    @endif

    <div class="relative overflow-x-auto m-auto w-2/3">
        <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Наименование товара
                </th>
                <th scope="col" class="px-6 py-3">
                    Количество
                </th>
                <th scope="col" class="px-6 py-3">
                    Цена
                </th>
                <th scope="col" class="px-6 py-3">
                    Сумма
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $id => $product)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $product['name'] }}
                    </th>
                    <td class="px-6 py-4 text-center">
                        {{ $product['quantity'] }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $product['price'] }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $product['price'] * $product['quantity'] }}
                    </td>
                    <td class="px-2 py-2 text-center">
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                            <input type="hidden" name="quantity" value="-1">
                            <button type="submit"
                                    class="w-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-2 px-4 rounded-full font-bold hover:bg-gray-300 dark:hover:bg-gray-600">
                                -
                            </button>
                        </form>
                    </td>
                    <td class="px-2 py-2 text-center">
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit"
                                    class="w-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-2 px-4 rounded-full font-bold hover:bg-gray-300 dark:hover:bg-gray-600">
                                +
                            </button>
                        </form>
                    </td>
                    <td class="px-2 py-2 text-center">
                        <form action="{{ route('cart.destroy', ['id' => $product['id']]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-2 px-4 rounded-full font-bold hover:bg-gray-300 dark:hover:bg-gray-600">
                                delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if($products->count() > 0)
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Очистить корзину</button>
        </form>
        <a href="{{ route('order.create') }}">Оформить заказ</a>
    @endif
@endsection

@section('footer')
    @include('components.footer')
@endsection
