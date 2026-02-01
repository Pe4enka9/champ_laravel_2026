@extends('theme')
@section('title', 'Авторизация')
@section('content')
    <form action="{{ route('login') }}" method="post" class="w-25 m-auto">
        @csrf
        <h1 class="mb-3">Авторизация</h1>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="name@example.com">
            @error('email') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Ваш пароль">
            @error('password') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn btn-success w-100">Войти</button>

        @error('auth') <div class="mt-3 alert alert-danger">{{ $message }}</div> @enderror
    </form>
@endsection
