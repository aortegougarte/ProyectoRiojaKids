<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Riojakids')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/kids.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg kids-navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('img/logoRiojaKids.png') }}" alt="RiojaKids" class="rk-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('animals.index') }}">🦊 Animales</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('videos.index') }}">🎓 Vídeos educativos</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('games.index') }}">🎮 Juegos</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('favorites.index') }}">⭐ Favoritos</a></li>
                @endauth
            </ul>

            <ul class="navbar-nav">
                @guest
                    <li class="nav-item"><a class="btn btn-outline-primary kids-pill me-2" href="{{ route('login') }}">Entrar</a></li>
                    <li class="nav-item"><a class="btn btn-primary kids-pill" href="{{ route('register') }}">Crear cuenta</a></li>
                @endguest

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item me-2">
                                <a class="btn btn-warning kids-pill" href="{{ route('admin.animals.index') }}">🛠 Admin</a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-outline-danger kids-pill">Salir</button>
                            </form>
                        </li>
                    @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if(session('status'))
        <div class="alert alert-success kids-card">{{ session('status') }}</div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
