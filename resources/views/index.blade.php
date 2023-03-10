@extends('layouts.main')

@section('title', 'Home')

@section('content')


    <h1>Все товары</h1>
    <form method="GET" action="{{route("index")}}">
      <div class="filters row">
          <div class="col-sm-6 col-md-3">
              <label for="price_from">Цена от
                  <input type="text" name="price_from" id="price_from" size="6" value="{{ request()->price_from }}">
              </label>
              <label for="price_to">До
                  <input type="text" name="price_to" id="price_to" size="6"  value="{{ request()->price_to }}">
              </label>
          </div>
          <div class="col-sm-2 col-md-2">
              <label for="hit">@lang('main.properties.hit')
                  <input type="checkbox" name="hit" id="hit" @if(request()->has('hit')) checked @endif>
              </label>
          </div>
          <div class="col-sm-2 col-md-2">
              <label for="new">@lang('main.properties.new')
                  <input type="checkbox" name="new" id="new" @if(request()->has('new')) checked @endif>
              </label>
          </div>
          <div class="col-sm-2 col-md-2">
              <label for="recommend">@lang('main.properties.recommend')
                  <input type="checkbox" name="recommend" id="recommend" @if(request()->has('recommend')) checked @endif>
              </label>
          </div>
          <div class="col-sm-6 col-md-3">
              <button type="submit" class="btn btn-primary">Филтер</button>
              <a href="{{ route("index") }}" class="btn btn-warning">Сброс</a>
          </div>
      </div>
  </form>

    <div class="row">
        @foreach ($products as $product)
            @include('layouts.card', compact('product'))
        @endforeach
    </div>

    <!-- <nav>
        <ul class="pagination">

          <li class="page-item disabled" aria-disabled="true" aria-label="pagination.previous">
            <span class="page-link" aria-hidden="true">&lsaquo;</span>
          </li>
          <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
          <li class="page-item"><a class="page-link" href="?&amp;page=2">2</a></li>
          <li class="page-item"><a class="page-link" href="?&amp;page=3">3</a></li>
          <li class="page-item"><a class="page-link" href="?&amp;page=4">4</a></li>
          <li class="page-item"><a class="page-link" href="?&amp;page=5">5</a></li>
          <li class="page-item"><a class="page-link" href="?&amp;page=6">6</a></li>
          <li class="page-item"><a class="page-link" href="?&amp;page=7">7</a></li>
          <li class="page-item">
            <a class="page-link" href="?&amp;page=2" rel="next" aria-label="pagination.next">&rsaquo;</a>
          </li>
        </ul>
      </nav> -->

  {{ $products->links() }}

@endsection
