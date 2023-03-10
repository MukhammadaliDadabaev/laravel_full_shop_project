@extends('auth.layouts.main')

@section('title', 'Заказ ' . $order->id)

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="justify-content-center">
                <div class="panel">
                    <h1>Заказ №{{ $order->id }}</h1>
                    <p>Заказчик: <b>{{ $order->name }}</b></p>
                    <p>Номер телефона: <b>{{ $order->phone }}</b></p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Кол-во</th>
                                <th>Цена</th>
                                <th>Стоимость</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                                            <img src="{{ Storage::url($product->image) }}" height="56px">
                                            {{ $product->name }}
                                        </a>
                                    </td>
                                    <td><span class="badge">1</span></td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->getPriceForCount() }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">Общая стоимость:</td>
                                <td>{{ $order->calculateFullSum() }}</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
</div>
@endsection
