@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1 class="flex items-center justify-center text-3xl font-bold mt-10 mb-16">Каталог товаров</h1>

    @include('components.product')

    <div class="flex items-center justify-center m-auto mt-8 w-1/4">
        <a href="{{ $products->previousPageUrl() }}"
           class="flex items-center justify-center px-4 h-10 w-1/2 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white
       @if ($products->onFirstPage()) pointer-events-none opacity-50 @endif">
            Previous
        </a>

        <a href="{{ $products->nextPageUrl() }}"
           class="flex items-center justify-center px-4 h-10 w-1/2 ms-3 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white
       @if (!$products->hasMorePages()) pointer-events-none opacity-50 @endif">
            Next
        </a>
    </div>

@endsection

@section('footer')
    @include('components.footer')
@endsection
