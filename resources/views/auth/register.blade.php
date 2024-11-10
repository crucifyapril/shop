@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1 class="text-3xl font-bold flex items-center justify-center mb-16 mt-10">Вход в личный кабинет</h1>

    @if ($errors->any())
        <div class="mb-5 text-red-500 text-center">
            @foreach ($errors->all() as $error)
                {{--<p>{{ $error }}</p>--}}
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="max-w-sm mx-auto">
        @csrf
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ivan" required />
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Электронная Почта</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Name@email.com" required />
            @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пароль</label>
            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter password" required />
            @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Подтверждение пароля</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Confirm password" required />
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Регистрация</button>
    </form>

    <div class="mt-4 text-center">
        <span class="text-sm text-gray-900 dark:text-white">Вы уже авторизованы? <a href="{{ route('login') }}" class="hover:underline text-blue-500">Войти</a></span>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection
