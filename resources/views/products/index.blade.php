@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1>Каталог товаров</h1>
    <ul>
        @foreach($products as $product)
            <li>
                {{ $product->name }} - {{ $product->price }} руб.
            </li>
        @endforeach
    </ul>

    {{ $products->links() }}
@endsection

@section('footer')
    @include('components.footer')
@endsection
