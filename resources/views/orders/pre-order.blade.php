@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1 class="text-3xl font-bold flex items-center justify-center mb-16 mt-10">Мы отправим вам на почту уведомление об поступлении</h1>

    @if ($errors->any())
        <div class="mb-5 text-red-500 text-center">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('order.pre-order.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $productId }}">
        <div class="grid gap-6 mb-6">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Электронная почта</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="johnDoe@email.com" required />
            </div>
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Комментарий</label>
                <input type="text" id="description" name="description" value="{{ old('description') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" />
            </div>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>



@endsection

@section('footer')
    @include('components.footer')
@endsection
