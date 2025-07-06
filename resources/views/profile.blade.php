@extends('layouts.app')

@section('title', 'Team North')

@section('body-class', 'bg-home')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">

  <!-- Имя игрока -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-uppercase fw-bold text-white mb-0">
        {{ $user->login }}
    </h1>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-primary">
        Выйти
      </button>
    </form>

    @if(Auth::check() && Auth::user()->role === 'admin')
      <a href="/dashboard" class="btn btn-primary">Админ панель</a>
    @endif
  </div>

  <!-- Основная статистика игрока -->
  <div class="row g-4 mb-4">
    <div class="col-6 col-md-4 col-lg-2">
      <div class="bg-light p-3 rounded shadow text-center">
        <h6 class="text-muted">Убийства</h6>
        <p class="fs-3 fw-bold text-dark mb-0">{{ $player->kills ?? '-' }}</p>
      </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
      <div class="bg-light p-3 rounded shadow text-center">
        <h6 class="text-muted">Смерти</h6>
        <p class="fs-3 fw-bold text-dark mb-0">{{ $player->deaths ?? '-' }}</p>
      </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
      <div class="bg-light p-3 rounded shadow text-center">
        <h6 class="text-muted">Дата вступления</h6>
        <p class="fs-5 text-dark mb-0">{{ $player->join_date ?? '-' }}</p>
      </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
      <div class="bg-light p-3 rounded shadow text-center">
        <h6 class="text-muted">Дней в команде</h6>
        <p class="fs-3 fw-bold text-dark mb-0">{{ $daysInTeam ?? '-' }}</p>
      </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
      <div class="bg-light p-3 rounded shadow text-center">
        <h6 class="text-muted">Роль</h6>
        <p class="fs-5 text-capitalize text-dark mb-0">{{ $player->clan_role ?? '-' }}</p>
      </div>
    </div>
  </div>

  <!-- Дополнительные данные -->
  <div class="row g-4 mb-4">
    <div class="col-md-4">
      <div class="bg-light p-3 rounded shadow text-center">
        <h6 class="text-muted">Специализация</h6>
        <p class="fs-5 text-dark mb-0">{{ $player->specialization ?? '-' }}</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="bg-light p-3 rounded shadow text-center">
        <h6 class="text-muted">Бригада</h6>
        <p class="fs-5 text-dark mb-0">{{ $player->brigade ?? '-' }}</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="bg-light p-3 rounded shadow text-center">
        <h6 class="text-muted">Отпуск</h6>
        <p class="fs-5 text-dark mb-0">{{ $player->on_holiday ?? '-' }}</p>
      </div>
    </div>
  </div>

  <!-- Раздел: статистика и график -->
  <div class="row g-4">

    <!-- Левая часть -->
    <div class="col-lg-8">
      <div class="row g-4">
        <div class="col-md-6">
          <div class="bg-light p-4 rounded shadow">
            <h5 class="text-muted">K/D</h5>
            <p class="fs-1 fw-bold text-dark mb-0">
              {{ $player->deaths > 0 ? round($player->kills / $player->deaths, 2) : '∞' }}
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="bg-light p-4 rounded shadow">
            <h5 class="text-muted">Результативность в компете</h5>
            <p class="fs-4 text-dark mb-0">{{ $player->compet_activity ?? '-' }}</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="bg-light p-4 rounded shadow">
            <h5 class="text-muted">Дни на ролях</h5>
            <p class="fs-6 text-dark mb-0">Новобранец: {{ $player->days_recruit ?? 0 }} д.</p>
            <p class="fs-6 text-dark mb-0">Трубовой: {{ $player->days_prospect ?? 0 }} д.</p>
            <p class="fs-6 text-dark mb-0">Основа: {{ $player->days_main ?? 0 }} д.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Правая часть: график -->
    <div class="col-lg-4">
      <div class="bg-light p-4 rounded shadow h-100 d-flex flex-column">
        <h5 class="text-muted mb-3">График статистики</h5>
        <div class="flex-grow-1 d-flex align-items-center justify-content-center">
          <!-- Здесь будет график -->
          <span class="text-muted">График в разработке</span>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
