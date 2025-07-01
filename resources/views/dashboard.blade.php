@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('body-class', 'bg-home')

@section('content')
<div class="container mt-4">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Игроки</h1>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal">
      Создать пользователя
    </button>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <!-- Таблица пользователей и игроков -->
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Ник</th>
        <th>Логин</th>
        <th>Убийства</th>
        <th>Смерти</th>
        <th>Дата вступления</th>
        <th>Роль в клане</th>
        <th>Действия</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->nickname ?? '-' }}</td>
        <td>{{ $user->login }}</td>
        <td>{{ $user->player->kills ?? '-' }}</td>
        <td>{{ $user->player->deaths ?? '-' }}</td>
        <td>{{ $user->player->join_date ?? '-' }}</td>
        <td>{{ $user->player->clan_role ?? '-' }}</td>
        <td>
          @if($user->player)
          <form method="POST" action="{{ route('admin.delete', $user->player) }}" onsubmit="return confirm('Удалить игрока и пользователя?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Удалить</button>
          </form>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Модальное окно создания -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ route('admin.create') }}">
      @csrf
      <div class="modal-content" style="background-color: #fff; color: #000;">
        <div class="modal-header">
          <h5 class="modal-title" id="createUserModalLabel">Создать игрока</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nickname" class="form-label">Ник</label>
            <input type="text" name="nickname" id="nickname" class="form-control" required value="{{ old('nickname') }}">
            @error('nickname')<div class="text-danger">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" name="login" id="login" class="form-control" required value="{{ old('login') }}">
            @error('login')<div class="text-danger">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
          </div>

          <hr>

          <h4>Данные игрока</h4>
          <div class="mb-3">
            <label for="join_date" class="form-label">Дата вступления</label>
            <input type="date" name="join_date" id="join_date" class="form-control" value="{{ old('join_date') }}">
          </div>

          <div class="mb-3">
            <label for="clan_role" class="form-label">Роль в клане</label>
            <input type="text" name="clan_role" id="clan_role" class="form-control" value="{{ old('clan_role') }}">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
          <button type="submit" class="btn btn-success">Создать</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection
