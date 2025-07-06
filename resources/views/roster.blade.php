@extends('layouts.app')

@section('title', 'Team North')

@section('body-class', 'bg-home')

@section('content')

<div class="container mt-5">
  <h2 class="mb-4 fw-bold border-bottom pb-2" style="color:rgb(255, 255, 255);">Список игроков</h2>

  <div class="table-responsive shadow rounded bg-white">
    <table class="table mb-0">
      <thead class="d-none"></thead> <!-- заголовок скрыт -->

      <tbody>
        @forelse($players as $player)
        <tr class="align-middle" style="border-bottom: 1px solid #e5e7eb;">
          <td class="py-3" style="font-size: 1.25rem; font-weight: 600; color: #1f2937;">
            {{ $player->user->nickname ?? '-' }}
          </td>
        </tr>
        @empty
        <tr>
          <td class="text-center text-muted py-4" style="font-size: 1.25rem;">
            Игроки не найдены
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>


@endsection
