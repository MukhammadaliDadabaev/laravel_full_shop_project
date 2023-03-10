<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if ($product->isNew())
                <span class="badge badge-success">@lang('main.properties.new')</span>
            @endif
            @if ($product->isRecommend())
                <span class="badge badge-warning">@lang('main.properties.recommend')</span>
            @endif
            @if ($product->isHit())
                <span class="badge badge-danger">@lang('main.properties.hit')</span>
            @endif

        </div>
        <img class="mt-2" src="{{ Storage::url($product->image) }}" alt="{{ $product->__('name') }}">
        <div class="caption">
            <h3>{{ $product->__('name') }}</h3>
            {{-- <h4>Цвет: Белый</h4>
            <h4>Внутренняя память: 32гб</h4> --}}
            <p>{{ $product->price }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</p>
            <p>
            <form action="{{ route('basket-add', $product) }}" method="POST">
                @csrf
                @if ($product->isAvailable())
                    <button type="submit" class="btn btn-primary" role="button">@lang('main.add_to_basket')</button>
                @else
                @lang('main.not_available')
                @endif
                <a href="{{ route('product', [isset($category) ? $category->code : $product->category->code, $product->code]) }}"
                    class="btn btn-default" role="button">@lang('main.more')</a>
            </form>
            </p>
        </div>
    </div>
</div>
