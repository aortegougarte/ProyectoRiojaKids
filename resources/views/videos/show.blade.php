@extends('layouts.app-kids')
@section('title', $video->title.' - RiojaKids')

@section('content')
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div>
            <h2 class="fw-bold mb-0">🎓 {{ $video->title }}</h2>
            <div class="text-muted">🏷 {{ $video->category }} · 👶 {{ $video->age_group }}</div>
        </div>

        <div class="d-flex gap-2">
            <a class="btn btn-outline-primary kids-pill" href="{{ route('videos.index') }}">← Volver</a>

            @auth
                <form method="POST" action="{{ route('favorites.video.toggle', $video) }}">
                    @csrf
                    @if($isFavorite)
                        <button class="btn btn-danger kids-pill">💔 Quitar favorito</button>
                    @else
                        <button class="btn btn-outline-danger kids-pill">❤️ Añadir favorito</button>
                    @endif
                </form>
            @endauth
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="kids-card p-3">
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://www.youtube-nocookie.com/embed/{{ $video->youtube_id }}"
                        title="{{ $video->title }}"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="kids-card p-4 rk-sheet">
                <h4 class="fw-bold mb-2">✨ Aprende algo nuevo</h4>
                <p class="mb-0" style="line-height:1.6;">
                    {{ $video->description ?: 'Este vídeo es perfecto para aprender jugando 😊' }}
                </p>

                <hr>

                <div class="rk-mini">
                    <div class="fw-bold mb-2">🎯 Consejito</div>
                    <div>Después del vídeo, prueba un juego:</div>
                    <div class="d-grid gap-2 mt-2">
                        <a class="btn btn-primary kids-pill" href="{{ route('games.quiz') }}">🧠 Mini-quiz</a>
                        <a class="btn btn-outline-primary kids-pill" href="{{ route('games.memory') }}">🃏 Memoria</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
