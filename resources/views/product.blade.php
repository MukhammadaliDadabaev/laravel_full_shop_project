@extends('layouts.main')

@section('title', 'Product')

@section('content')

    <h1>{{ $product->__('name') }}</h1>
    <h2>{{ $product->category->name }}</h2>
    <h2>Мобильные телефоны</h2>
    <p>Цена: <b>{{ $product->price }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</b></p>
    {{-- <h4>Цвет: Белый</h4> --}}
    {{-- <h4>Внутренняя память: 128гб</h4> --}}
    <img style="height: 350px" width="500px" src="{{ Storage::url($product->image) }}">
    <p>{{ $product->__('description') }}</p>

    @if ($product->isAvailable())
        <form action="{{ route('basket-add', $product) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
        </form>
    @else
        <span>Не доступен</span>
        <br>
        <span><b>Собщить мне, когда товар появится в наличии: </b></span>
        <div class="text-danger">
            @if ($errors->get('email'))
            <h3>{{ $errors->get('email')[0] }}</h3>
            @endif
        </div>
        <form action="{{ route('subscription', $product) }}" method="POST">
            @csrf
            <input type="text" name="email" id="">
            <button type="submit" class="btn btn-success" role="button">Отправить</button>
        </form>
    @endif

@endsection
