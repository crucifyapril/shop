@extends('base')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1 class="text-3xl font-bold flex items-center justify-center mb-16 mt-10">Случайные товары</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Ошибка:</strong>
            <span class="block sm:inline">{{ $errors->first() }}</span>
        </div>
    @endif

    @include('components.product')

@endsection

@section('footer')
    @include('components.footer')
@endsection
