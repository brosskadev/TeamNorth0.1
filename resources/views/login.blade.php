@extends('layouts.app')

@section('title', 'Team North')

@section('body-class', 'bg-home')

@section('content')

<div class="section-wrapper" style="display: flex; justify-content: center; align-items: center; height: 80vh; margin: 0; padding: 0;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; background-color:rgb(255, 255, 255);">
        <h2 class="text-center mb-4">Вход</h2>

        <form method="POST" action="/login">
    @csrf
    <!-- Email -->
    <div class="mb-3">
    <label for="nickname" class="form-label">Логин</label>
    <input
        type="text"
        id="login"
        name="login"
        class="form-control @error('login') is-invalid @enderror"
        value="{{ old('login') }}"
        required
    >
    @error('login')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">Пароль</label>
    <input
        type="password"
        id="password"
        name="password"
        class="form-control"
        required
    >
</div>

<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="remember" name="remember">
    <label class="form-check-label" for="remember">Запомнить меня</label>
</div>

    <!-- Кнопка входа -->
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Войти</button>
    </div>
</form>


    </div>
</div>

@endsection