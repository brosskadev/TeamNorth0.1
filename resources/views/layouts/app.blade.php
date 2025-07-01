<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'сайт')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/N.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="/css/app.css" rel="stylesheet">
</head>
<body class="@yield('body-class')">
    <div class="nav-container d-flex justify-content-around align-items-center py-1">

        <a class="navnorth-container d-flex align-items-center gap-3" href="/">
          <img src="{{ asset('images/N.png') }}" alt="N" style="height: 60px; width: auto;" />
            <div class="text-container text-start">
            <span class="team-name">TEAM NORTH</span><br>
            <span class="team-tagline">БИЛЕТ В КОМПЕТ</span>
            </div>
        </a>
         <div class="nav-dropdown">
            <a class="nav-link" href="#">Команда</a>

            <div class="dropdown-menu">
              <a class="dropdown-item" href="/about">О нас</a>
              <a class="dropdown-item" href="/">Новости</a>
              <a class="dropdown-item" href="/">Результаты</a>
            </div>
         </div>

        <a class="nav-link" href="/">Расписание</a>
          <div class="nav-dropdown">
            <a class="nav-link" href="#">Сервисы</a>

            <div class="dropdown-menu">
              <a class="dropdown-item" href="/">Тактика</a>
              </div>
          </div>
        <a class="nav-link" href="/">Академия</a>
        <a class="nav-link" href="https://discord.gg/teamnorth">
          <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/discord.svg" alt="Discord" style="height: 24px; filter: invert(1);" />
        </a>
        @if(Auth::check())
          <a href="{{ route('profile.by.login', Auth::user()->login) }}" class="btn btn-primary">Профиль</a>

        @else
          <a href="{{ route('login') }}" class="btn btn-primary">Войти</a>
        @endif
    </div>


        <div id="app">
          <stroka></stroka>

          @yield('content')

        </div>


    <footer class="bg-dark text-light py-3 mt-auto">
  <div class="container d-flex justify-content-between align-items-center flex-wrap">
    <div>
      &copy; 2018-2025 Team North. Все фобы выкопаны, рали сожжены, а права защищены.
    </div>
    <div>
      <a href="/" class="text-light me-3 text-decoration-none">О команде</a>
      <a href="/academy" class="text-light me-3 text-decoration-none">Присоединиться</a>
      <a href="https://youtu.be/PU8o9R-Vrfc?si=aXZM_vMnv61OgNLv&t=119" class="text-light text-decoration-none">Политика конфиденциальности</a>
    </div>
  </div>
</footer>

</body>
</html>

@vite('resources/js/app.js')
