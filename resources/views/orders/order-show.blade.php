@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1 class="flex items-center justify-center text-3xl font-bold mt-10 mb-16">Заказ #{{ $order->id }}</h1>


    <section class="py-24 relative">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">

            <h2 class="font-manrope font-bold text-3xl sm:text-4xl leading-10 text-black mb-11">
                Заказ оформлен
            </h2>
            <h6 class="font-medium text-xl leading-8 text-black mb-3">Привет, {{ auth()->user()->name }}</h6>
            <p class="font-normal text-lg leading-8 text-gray-500 mb-11">Ваш заказ выполнен и будет
                доставлен 20 февраля.</p>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-8 py-6 border-y border-gray-100 mb-6">
                <div class="box group">
                    <p class="font-normal text-base leading-7 text-gray-500 mb-3 transition-all duration-500 group-hover:text-gray-700">Статус</p>
                    <h6 class="font-semibold font-manrope text-2xl leading-9 text-black">{{ $order->status }}</h6>
                </div>
                <div class="box group">
                    <p class="font-normal text-base leading-7 text-gray-500 mb-3 transition-all duration-500 group-hover:text-gray-700">Заказ</p>
                    <h6 class="font-semibold font-manrope text-2xl leading-9 text-black">#{{ $order->id }}</h6>
                </div>
                <div class="box group">
                    <p class="font-normal text-base leading-7 text-gray-500 mb-3 transition-all duration-500 group-hover:text-gray-700">Метод платежа</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="46" height="32" viewBox="0 0 46 32" fill="none">
                        <rect x="0.5" y="0.5" width="45" height="31" rx="5.5" fill="#1F72CD" />
                        <rect x="0.5" y="0.5" width="45" height="31" rx="5.5" stroke="#F3F4F6" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M8.1282 11.333L3.88672 20.9953H8.96437L9.59385 19.4548H11.0327L11.6622 20.9953H17.2512V19.8195L17.7493 20.9953H20.6404L21.1384 19.7947V20.9953H32.7621L34.1755 19.4948L35.4989 20.9953L41.4691 21.0078L37.2143 16.1911L41.4691 11.333H35.5915L34.2157 12.8058L32.9339 11.333H20.2888L19.203 13.8269L18.0917 11.333H13.0246V12.4688L12.461 11.333H8.1282ZM9.1107 12.7051H11.5858L14.3992 19.2571V12.7051H17.1105L19.2835 17.4029L21.2862 12.7051H23.984V19.6384H22.3424L22.329 14.2055L19.9358 19.6384H18.4674L16.0607 14.2055V19.6384H12.6837L12.0435 18.0841H8.58456L7.94566 19.6371H6.13627L9.1107 12.7051ZM32.1608 12.7051H25.4859V19.6343H32.0574L34.1755 17.3379L36.217 19.6343H38.3512L35.2493 16.1898L38.3512 12.7051H36.3096L34.2023 14.9752L32.1608 12.7051ZM10.3147 13.8782L9.17517 16.6471H11.453L10.3147 13.8782ZM27.1342 15.4063V14.1406V14.1394H31.2991L33.1165 16.1636L31.2186 18.1988H27.1342V16.817H30.7756V15.4063H27.1342Z"
                              fill="white" />
                    </svg>
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
            <div class="flex items-center justify-center sm:justify-end w-full border-b border-gray-100 my-6">
                <div class=" w-full">
                    <div class="flex items-center justify-between mb-6 mt-6">
                        <p class="font-normal text-xl leading-8 text-white">Всего</p>
                        <p class="font-semibold text-xl leading-8 text-white">{{ $order->product->price }} руб</p>
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <p class="font-normal text-xl leading-8 text-white">Доставка</p>
                        <p class="font-semibold text-xl leading-8 text-white">0 руб</p>
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <p class="font-normal text-xl leading-8 text-white">НДС</p>
                        <p class="font-semibold text-xl leading-8 text-white">0 руб</p>
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <p class="font-normal text-xl leading-8 text-white">Скидка</p>
                        <p class="font-semibold text-xl leading-8 text-white">0 руб</p>
                    </div>
                    <div class="flex items-center justify-between py-6 border-y border-gray-100">
                        <p class="font-manrope font-semibold text-2xl leading-9 text-white">Общая сумма</p>
                        <p class="font-manrope font-bold text-2xl leading-9 text-white">{{ $order->product->price }} руб</p>
                    </div>
                </div>
            </div>
            <div class="data ">
                <p class="font-normal text-lg leading-8 text-gray-500 mb-11">Мы отправим электронное письмо с подтверждением доставки,
                    когда товары будут успешно отправлены.</p>
                <h6 class="font-manrope font-bold text-2xl leading-9 text-black mb-3">Спасибо, что делаете
                    покупки у нас!</h6>
                <p class="font-medium text-xl leading-8 text-indigo-600">Tractatus Logico Store</p>
            </div>
        </div>
    </section>


@endsection

@section('footer')
    @include('components.footer')
@endsection
