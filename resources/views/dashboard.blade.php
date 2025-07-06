@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('body-class', 'bg-home')

@section('content')
<div class="container mt-4">

  <!-- Вкладки -->
  <ul class="nav nav-tabs mb-3" id="adminTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="players-tab" data-bs-toggle="tab" data-bs-target="#players" type="button" role="tab" aria-controls="players" aria-selected="true">
        Игроки
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="games-tab" data-bs-toggle="tab" data-bs-target="#games" type="button" role="tab" aria-controls="games" aria-selected="false">
        Игры
      </button>
    </li>
  </ul>

  <!-- Контент вкладок -->
  <div class="tab-content" id="adminTabsContent">

    <!-- Вкладка Игроки -->
    <div class="tab-pane fade show active" id="players" role="tabpanel" aria-labelledby="players-tab">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Игроки</h1>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal">
          Создать пользователя
        </button>
      </div>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Ник</th>
            <th>Логин</th>
            <th>Steam ID</th>
            <th>Специализация</th>
            <th>Бригада</th>
            <th>Дата вступления</th>
            <th>Дни в команде</th>
            <th>Новобранец</th>
            <th>Трудовой</th>
            <th>Основа</th>
            <th>Убийства</th>
            <th>Смерти</th>
            <th>Отпуск</th>
            <th>Роль в клане</th>
            <th>Действия</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>
              @if($user->nickname)
                <a href="{{ route('profile.by.login', ['login' => $user->login]) }}">
                  {{ $user->nickname }}
                </a>
              @else
                -
              @endif
            </td>
            <td>{{ $user->login }}</td>
            <td>{{ $user->player->steam_id ?? '-' }}</td>
            <td>{{ $user->player->specialization ?? '-' }}</td>
            <td>{{ $user->player->brigade ?? '-' }}</td>
            <td>{{ $user->player->join_date?? '-' }}</td>
            <td>
            @if($user->player && $user->player->join_date)
                {{ floor(\Carbon\Carbon::parse($user->player->join_date)->diffInHours(\Carbon\Carbon::now()) / 24) }}
            @else
                -
            @endif
            </td>
            <td>{{ $user->player->days_recruit ?? '-' }}</td>
            <td>{{ $user->player->days_prospect ?? '-' }}</td>
            <td>{{ $user->player->days_main ?? '-' }}</td>
            <td>{{ $user->player->kills ?? '-' }}</td>
            <td>{{ $user->player->deaths ?? '-' }}</td>
            <td>{{ $user->player->on_holiday ?? '-' }}</td>
            <td>{{ $user->player->clan_role ?? '-' }}</td>
            <td>
              @if($user->player)
              <form method="POST" action="{{ route('admin.delete', $user->player) }}" onsubmit="return confirm('Удалить игрока и пользователя?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Удалить</button>
              </form>

              <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPlayerModal-{{ $user->player->id }}">
                Редактировать
              </button>

              <!-- Модальное окно редактирования -->
              <div class="modal fade" id="editPlayerModal-{{ $user->player->id }}" tabindex="-1" aria-labelledby="editPlayerModalLabel-{{ $user->player->id }}" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <form method="POST" action="{{ route('admin.update', $user->player->id) }}">
                  @csrf
                  @method('PUT')
                  <div class="modal-content" style="background-color: #fff; color: #000;">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editPlayerModalLabel-{{ $user->player->id }}">Редактировать игрока</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                    @if($errors->any())
                      <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                          <div>{{ $error }}</div>
                        @endforeach
                      </div>
                    @endif  

                      <div class="mb-3">
                        <label class="form-label">Ник</label>
                        <input type="text" name="nickname" class="form-control" value="{{ $user->nickname }}">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Логин</label>
                        <input type="text" name="login" class="form-control" value="{{ $user->login }}">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Steam ID</label>
                        <input type="text" name="steam_id" class="form-control" value="{{ $user->player->steam_id }}">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Специализация</label>
                        <input type="text" name="specialization" class="form-control" value="{{ $user->player->specialization }}">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Бригада</label>
                        <input type="text" name="brigade" class="form-control" value="{{ $user->player->brigade }}">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Дата вступления</label>
                        <input type="date" name="join_date" class="form-control" value="{{ $user->player->join_date ? \Carbon\Carbon::parse($user->player->join_date)->format('Y-m-d') : '' }}">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Новобранец</label>
                        <input type="number" name="days_recruit" class="form-control" value="{{ $user->player->days_recruit }}">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Трудовой</label>
                        <input type="number" name="days_prospect" class="form-control" value="{{ $user->player->days_prospect }}">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Основа</label>
                        <input type="number" name="days_main" class="form-control" value="{{ $user->player->days_main }}">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Убийства</label>
                        <input type="number" name="kills" class="form-control" value="{{ $user->player->kills }}">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Смерти</label>
                        <input type="number" name="deaths" class="form-control" value="{{ $user->player->deaths }}">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Роль в клане</label>
                        <input type="text" name="clan_role" class="form-control" value="{{ $user->player->clan_role }}">
                      </div>
                      <div class="form-check mb-3">
                        <input 
                          class="form-check-input" 
                          type="checkbox" 
                          name="on_holiday" 
                          id="holidayCheckbox-{{ $user->player->id }}" 
                          {{ $user->player->on_holiday ? 'checked' : '' }}>
                        <label class="form-check-label" for="holidayCheckbox-{{ $user->player->id }}">Отпуск</label>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                      <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Вкладка Игры -->
    <div class="tab-pane fade" id="games" role="tabpanel" aria-labelledby="games-tab">
      <h2 class="mt-3">Игры</h2>
      <p>Здесь будет список игр или результаты матчей.</p>
      <!-- TODO: вставь таблицу игр или матчей -->
    </div>

  </div>
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
            <label for="steam_id" class="form-label">Steam ID</label>
            <input type="text" name="steam_id" id="steam_id" class="form-control" value="{{ old('steam_id') }}">
          </div>
          <div class="mb-3">
            <label for="specialization" class="form-label">Специализация</label>
            <input type="text" name="specialization" id="specialization" class="form-control" value="{{ old('specialization') }}">
          </div>
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
