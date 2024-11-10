@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1 class="text-3xl font-bold flex items-center justify-center mb-16 mt-10">Случайные товары</h1>

    @include('components.product')

@endsection

@section('footer')
    @include('components.footer')
@endsection
