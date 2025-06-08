<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Мой сайт')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/N.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body class="@yield('body-class')">
    <div class="nav-container d-flex justify-content-around align-items-center py-1">
        <img src="{{ asset('images/N.png') }}" alt="N" style="height: 60px; width: auto;" />
        <a class="nav-link" href="/about">О команде</a>
        <a class="nav-link" href="/north-history">История</a>
        <a class="nav-link" href="/old-rosters">Old Rosters</a>
        <a class="nav-link" href="/join-north">Вступить</a>
        <a href="/login" class="btn btn-primary">Войти</a>
    </div>
    
        @yield('content')

    <footer class="bg-dark text-light py-3 mt-auto">
  <div class="container d-flex justify-content-between align-items-center flex-wrap">
    <div>
      &copy; 2025 Team North. Все фобы выкопаны, рали сожжены, а права защищены.
    </div>
    <div>
      <a href="/" class="text-light me-3 text-decoration-none">О команде</a>
      <a href="/join-north" class="text-light me-3 text-decoration-none">Вступить</a>
      <a href="https://youtu.be/PU8o9R-Vrfc?si=aXZM_vMnv61OgNLv&t=119" class="text-light text-decoration-none">Политика конфиденциальности</a>
    </div>
  </div>
</footer>

</body>
</html>
