@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1 class="text-3xl font-bold flex items-center justify-center mb-16 mt-10">Избранное</h1>

    <div class="relative overflow-x-auto m-auto w-2/3">
        <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Название
                </th>
                <th scope="col" class="px-6 py-3">
                    Описание
                </th>
                <th scope="col" class="px-6 py-3">
                    Цена
                </th>
                <th scope="col" class="px-6 py-3">
                    Доступен
                </th>
                <th scope="col" class="px-6 py-3">
                    Подробнее
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($favorites as $product)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $product->name }}
                    </th>
                    <td class="px-6 py-4 text-center">
                        {{ $product->description }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $product->price }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if ($product->quantity > 0) Да @else Нет @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('products.show', ['id' => $product->id]) }}">
                            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                Перейти
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if ($favorites->count() > 30)
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
