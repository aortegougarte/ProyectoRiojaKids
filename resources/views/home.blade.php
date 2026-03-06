@extends('layouts.app-kids')
@section('title', 'Inicio - RiojaKids')

@section('content')
    <div class="kids-card p-4 mb-4 rk-hero">
        <div class="text-center position-relative" style="z-index:1;">
            <img src="{{ asset('img/logoRiojaKids.png') }}" alt="RiojaKids" class="rk-hero-logo">
            <h1 class="fw-bold mb-2 mt-3">¡Bienvenido/a a RiojaKids!</h1>
            <p class="mb-0">Aprende con animales y vídeos. Guarda tus favoritos ❤️</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <a class="text-decoration-none" href="{{ route('animals.index') }}">
                <div class="kids-card p-3 h-100">
                    <div style="font-size:1.6rem;">🦊</div>
                    <h4 class="fw-bold mt-2 mb-1">Animales</h4>
                    <p class="text-muted mb-0">Fotos y fichas divertidas</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a class="text-decoration-none" href="{{ route('videos.index') }}">
                <div class="kids-card p-3 h-100">
                    <div style="font-size:1.6rem;">🎓</div>
                    <h4 class="fw-bold mt-2 mb-1">Vídeos educativos</h4>
                    <p class="text-muted mb-0">Aprende con canciones y curiosidades</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a class="text-decoration-none" href="{{ route('games.index') }}">
                <div class="kids-card p-3 h-100">
                    <div style="font-size:1.6rem;">🎮</div>
                    <h4 class="fw-bold mt-2 mb-1">Juegos</h4>
                    <p class="text-muted mb-0">Memoria y mini-quiz</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            @auth
                <a class="text-decoration-none" href="{{ route('favorites.index') }}">
                    <div class="kids-card p-3 h-100">
                        <div style="font-size:1.6rem;">⭐</div>
                        <h4 class="fw-bold mt-2 mb-1">Favoritos</h4>
                        <p class="text-muted mb-0">Tienes {{ $favoriteCount }} guardados</p>
                    </div>
                </a>
            @else
                <a class="text-decoration-none" href="{{ route('login') }}">
                    <div class="kids-card p-3 h-100">
                        <div style="font-size:1.6rem;">🔐</div>
                        <h4 class="fw-bold mt-2 mb-1">Inicia sesión</h4>
                        <p class="text-muted mb-0">Para guardar favoritos</p>
                    </div>
                </a>
            @endauth
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-between mb-2">
        <h3 class="fw-bold mb-0">🎓 Últimos vídeos educativos</h3>
        <a class="btn btn-outline-primary kids-pill" href="{{ route('videos.index') }}">Ver todos</a>
    </div>

    @if($latestVideos->count() === 0)
        <div class="kids-card p-3 mb-4">Aún no hay vídeos. El admin puede añadirlos en <code>/admin/videos</code>.</div>
    @else
        <div class="row g-3 mb-4">
            @foreach($latestVideos as $v)
                <div class="col-md-4">
                    <div class="kids-card p-3 h-100">
                        <a class="fw-bold rk-link" href="{{ route('videos.show', $v) }}">{{ $v->title }}</a>
                        <div class="text-muted small">🏷 {{ $v->category }} · 👶 {{ $v->age_group }}</div>

                        <div class="ratio ratio-16x9 mt-2">
                            <iframe src="https://www.youtube-nocookie.com/embed/{{ $v->youtube_id }}" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-between mb-2">
        <h3 class="fw-bold mb-0">🦊 Animales destacados</h3>
        <a class="btn btn-outline-primary kids-pill" href="{{ route('animals.index') }}">Ver todos</a>
    </div>

    @if($featuredAnimals->count() === 0)
        <div class="kids-card p-3">Aún no hay animales. El admin puede añadirlos en <code>/admin/animales</code>.</div>
    @else
        <div class="row g-3">
            @foreach($featuredAnimals as $a)
                <div class="col-6 col-md-3">
                    <a class="kids-card p-2 h-100 d-block" href="{{ route('animals.show', $a) }}">
                        <img src="{{ $a->photo_url }}" class="w-100 rounded-4" style="aspect-ratio:1/1;object-fit:cover;">
                        <div class="p-2">
                            <div class="fw-bold">{{ $a->name }}</div>
                            <div class="text-muted small">{{ $a->environment === 'mar' ? '🌊 Mar' : '🌳 Tierra' }} · {{ ucfirst($a->animal_type) }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
@endsection
