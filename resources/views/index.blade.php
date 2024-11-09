@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1 class="text-3xl font-bold">Топ 5 товаров</h1>

    @include('components.product')

@endsection

@section('footer')
    @include('components.footer')
@endsection
