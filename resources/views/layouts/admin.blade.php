<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel Admin - RiojaKids')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg admin-navbar px-3">
    <a class="navbar-brand text-white fw-bold d-flex align-items-center gap-2"
       href="{{ route('admin.animals.index') }}">
        <img src="{{ asset('img/logoRiojaKids.png') }}" style="height:34px" alt="RiojaKids">
        RiojaKids Admin
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="adminNav">
        <ul class="navbar-nav me-auto gap-2 ms-3">
            <li class="nav-item">
                <a class="btn btn-outline-light btn-sm"
                   href="{{ route('admin.animals.index') }}">
                    🐾 Animales
                </a>
            </li>

            <li class="nav-item">
                <a class="btn btn-outline-light btn-sm"
                   href="{{ route('admin.videos.index') }}">
                    🎬 Vídeos
                </a>
            </li>
        </ul>

        <div class="d-flex gap-2">
            <a href="{{ url('/') }}" class="btn btn-outline-light btn-sm">Ver web</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm">Salir</button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
