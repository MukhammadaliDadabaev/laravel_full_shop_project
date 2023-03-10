@extends('auth.layouts.main')

@section('title', 'Авторизация')

@section('content')
<div class="col-md-8">
  <div class="card">
    <div class="card-header">Авторизация</div>

    {{-- @if (session('status'))
    <div class="flex gap-3 rounded-md border border-green-500 bg-green-50 p-4 mb-5">
      <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
      </svg>
      <h3 class="text-sm font-medium text-green-800">{{ session('status') }}</h3>
    </div>
    @endif --}}

    <div class="card-body">
      <form method="POST" action="{{ route('login') }}" aria-label="Login">
        @csrf
        <div class="form-group row">
          <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail</label>

          <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="" required autofocus>

          </div>
        </div>

        <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

          <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" required>

          </div>
        </div>
        <div class="form-group row mb-0">
          <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
              Войти
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection