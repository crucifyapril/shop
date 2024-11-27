@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1 class="flex items-center justify-center text-3xl font-bold mt-10 mb-16">Заказ #{{ $order->id }}</h1>


    <section class="py-24 relative">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-8 py-6 border-y border-gray-100 mb-6">
                <div class="box group">
                    <p class="font-normal text-base leading-7 text-gray-500 mb-3 transition-all duration-500 group-hover:text-gray-700">Статус</p>
                    <h6 class="font-semibold font-manrope text-2xl leading-9 text-black">{{ $order->status->name }}</h6>
                </div>
                <div class="box group">
                    <p class="font-normal text-base leading-7 text-gray-500 mb-3 transition-all duration-500 group-hover:text-gray-700">Заказчик</p>
                    <h6 class="font-semibold font-manrope text-2xl leading-9 text-black">{{ auth()->user()->name }}</h6>
                </div>
                <div class="box group">
                    <p class="font-normal text-base leading-7 text-gray-500 mb-3 transition-all duration-500 group-hover:text-gray-700">Почта</p>
                    <h6 class="font-semibold font-manrope text-2xl leading-9 text-black">{{ auth()->user()->email }}</h6>
                </div>
                <div class="box group">
                    <p class="font-normal text-base leading-7 text-gray-500 mb-3 transition-all duration-500 group-hover:text-gray-700">Комментарий к заказу</p>
                    <h6 class="font-semibold font-manrope text-2xl leading-9 text-black"> {{ $order->description ?? 'Нет комментария' }}
                    </h6>
                </div>
            </div>
            <div class="relative overflow-x-auto m-auto w-2/3">
                <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Наименование
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
                    </tr>
                    </thead>
                    <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 hover:underline py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('products.show', ['id' => $order->product->id]) }}">{{ $order->product->id }}</a>
                    </th>
                    <td class="px-6 py-4 text-center hover:underline">
                        <a href="{{ route('products.show', ['id' => $order->product->id]) }}">{{ $order->product->name }}</a>
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $order->total_amount }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $order->product->price }} руб
                    </td>
                    <td class="px-6 py-4 text-center ">
                        {{ $order->product->price }} руб
                    </td>
                </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex items-center justify-center sm:justify-end w-full my-6">
                <div class=" w-full">
                    <div class="flex items-center justify-between py-6 border-y border-gray-100">
                        <p class="font-manrope font-semibold text-2xl leading-9 text-white">Общая сумма</p>
                        <p class="font-manrope font-bold text-2xl leading-9 text-white">{{ $order->product->price }} руб</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('footer')
    @include('components.footer')
@endsection
