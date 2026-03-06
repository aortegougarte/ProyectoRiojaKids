@extends('layouts.app-kids')
@section('title', 'Juegos - RiojaKids')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="fw-bold mb-0">🎮 Juegos</h2>
    </div>

    <div class="kids-card p-4 mb-3 rk-hero">
        <h3 class="fw-bold mb-1">¡A jugar y aprender! ✨</h3>
        <p class="mb-0">Elige un juego cortito. No necesitas instalar nada.</p>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <a class="kids-card p-4 d-block h-100" href="{{ route('games.memory') }}">
                <div style="font-size:2rem;">🃏</div>
                <h4 class="fw-bold mt-2">Juego de Memoria</h4>
                <p class="text-muted mb-0">Encuentra las parejas de animales.</p>
            </a>
        </div>

        <div class="col-md-6">
            <a class="kids-card p-4 d-block h-100" href="{{ route('games.quiz') }}">
                <div style="font-size:2rem;">🧠</div>
                <h4 class="fw-bold mt-2">Mini-Quiz</h4>
                <p class="text-muted mb-0">Responde preguntas rápidas y suma aciertos.</p>
            </a>
        </div>
    </div>
@endsection
