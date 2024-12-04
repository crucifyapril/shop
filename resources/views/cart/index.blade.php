@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1 class="text-3xl font-bold flex items-center justify-center mb-16 mt-10">Корзина</h1>


    <form action="{{ route('cart.clear') }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" name="product_id" {{--value="{{ $product_id }}"--}}>
        <button type="submit">Очистить корзину</button>
    </form>

@endsection

@section('footer')
    @include('components.footer')
@endsection
