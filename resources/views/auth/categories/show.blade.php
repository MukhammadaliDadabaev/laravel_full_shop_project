@extends('auth.layouts.main')

@section('title', 'Категории' . $category->name)

@section('content')
<div class="col-md-12">
  <h1>Категория Мобильные телефоны</h1>
  <table class="table">
    <tbody>
      <tr>
        <td>ID</td>
        <td>{{ $category->id }}</td>
      </tr>
      <tr>
        <td>Код</td>
        <td>{{ $category->code }}</td>
      </tr>
      <tr>
        <td>Название</td>
        <td>{{ $category->name }}</td>
      </tr>
      <tr>
        <td>Название en</td>
        <td>{{ $category->name_en }}</td>
      </tr>
      <tr>
        <td>Описание</td>
        <td>{{ $category->description }}</td>
      </tr>
      <tr>
        <td>Описание en</td>
        <td>{{ $category->description_en }}</td>
      </tr>
      <tr>
        <td>Картинка</td>
        <td><img src="{{ Storage::url($category->image) }}" height="230px"></td>
      </tr>
      <tr>
        <td>Кол-во товаров</td>
        <td>4</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection