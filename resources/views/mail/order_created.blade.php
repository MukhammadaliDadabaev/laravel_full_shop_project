<h1>Mail o'tdi..ISMI {{ $name }}</h1>
<h1>@lang('mail/order_created.your_order') {{  $fullSum }} saqlandi.</h1>

<table>
  <tbody>
    @foreach ($order->products as $product)
<tr>
  <td>
    <a href="{{ route('product',[$product->category->code, $product->code]) }}">
      <img height="56px" src="{{ Storage::url($product->image) }}">
      {{ $product->__('name') }}
    </a>
  </td>
  <td><span class="badge">{{ $product->pivot->count }}</span>
    <div class="btn-group form-inline">
     {{!! $product->__('description') !!}}
    </div>
  </td>
  <td>{{ $product->price }} ₽</td>
  <td>{{ $product->getPriceForCount() }} ₽</td>
</tr>
@endforeach
  </tbody>
</table>