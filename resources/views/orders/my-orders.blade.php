@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1 class="flex items-center justify-center text-3xl font-bold mt-10 mb-16">Мои заказы</h1>



    <div class="relative overflow-x-auto m-auto w-1/2">
        <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Номер заказа
                </th>
                <th scope="col" class="px-6 py-3">
                    Статус
                </th>
                <th scope="col" class="px-6 py-3">
                    Сумма
                </th>
                <th scope="col" class="px-6 py-3">
                    Дата заказа
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('order.show', ['id' => $order->id]) }}">{{ $order->id }}</a>
                    </th>
                    <td class="px-6 py-4 text-center">
                        {{ $order->status }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $order->product->price }} руб
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $order->created_at }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if ($orders->count() > 30)
        <div class="flex items-center justify-center m-auto mt-8 w-1/4">
            <a href="{{ $paginate->previousPageUrl() }}"
               class="flex items-center justify-center px-4 h-10 w-1/2 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white
       @if ($paginate->onFirstPage()) pointer-events-none opacity-50 @endif">
                Previous
            </a>

            <a href="{{ $paginate->nextPageUrl() }}"
               class="flex items-center justify-center px-4 h-10 w-1/2 ms-3 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white
       @if (!$paginate->hasMorePages()) pointer-events-none opacity-50 @endif">
                Next
            </a>
        </div>

    @endif
@endsection

@section('footer')
    @include('components.footer')
@endsection
