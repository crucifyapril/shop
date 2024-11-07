@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1>Каталог товаров</h1>
    <ul>
        @foreach($products as $product)
            <li>
                <a>{{ $product->name }}</a> - {{ $product->price }} руб.
            </li>
        @endforeach
    </ul>
@endsection

@section('footer')
    @include('components.footer')
@endsection
