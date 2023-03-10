@extends('auth.layouts.main')

@section('title', 'Категории')

@section('content')
<div class="col-md-12">
  <h1>Категории</h1>
  <table class="table">
    <tbody>
      <tr>
        <th>
          #
        </th>
        <th>
          Код
        </th>
        <th>
          Название
        </th>
        <th>
          Действия
        </th>
      </tr>
      <tr>
        @foreach($categories as $category)
        <td>{{ $category->id }}</td>
        <td>{{ $category->code }}</td>
        <td>{{ $category->name }}</td>
        <td>
          <div class="btn-group" role="group">
            <form action="{{ route('categories.destroy', $category) }}" method="POST">
              @csrf
              @method('DELETE')
              <a class="btn btn-success" type="button" href="{{ route('categories.show', $category) }}">Открыть</a>
              <a class="btn btn-warning" type="button" href="{{ route('categories.edit', $category) }}">Редактировать</a>
              <input type="hidden" name="_method" value="DELETE">
              <input class="btn btn-danger" type="submit" value="Удалить">
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $categories->links() }}
  <a class="btn btn-success mt-3" type="button" href="{{ route('categories.create') }}">Добавить категорию</a>
</div>
</div>
@endsection