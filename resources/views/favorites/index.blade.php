@extends('layouts.app-kids')
@section('title', 'Mis favoritos - RiojaKids')

@section('content')
    <h2 class="fw-bold mb-3">⭐ Mis favoritos</h2>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="kids-card p-3 h-100">
                <h4 class="fw-bold mb-3">🎬 Vídeos favoritos</h4>

                @if($favoriteVideos->count() === 0)
                    <p class="mb-0 text-muted">Aún no tienes vídeos en favoritos.</p>
                @else
                    <div class="row g-3">
                        @foreach($favoriteVideos as $v)
                            <div class="col-12">
                                <div class="kids-card p-3">
                                    <a class="rk-card-title" href="{{ route('videos.show', $v) }}">{{ $v->title }}</a>
                                    <div class="text-muted small mb-2">🏷 {{ $v->category }} · 👶 {{ $v->age_group }}</div>

                                    <a href="{{ route('videos.show', $v) }}" class="d-block">
                                        <img class="rounded-4 w-100" style="height:220px;object-fit:cover;" src="https://img.youtube.com/vi/{{ $v->youtube_id }}/hqdefault.jpg" alt="{{ $v->title }}">
                                    </a>

                                    <form method="POST" action="{{ route('favorites.video.toggle', $v) }}" class="mt-2">
                                        @csrf
                                        <button class="btn btn-outline-danger kids-pill">💔 Quitar</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-6">
            <div class="kids-card p-3 h-100">
                <h4 class="fw-bold mb-3">🦊 Animales favoritos</h4>

                @if($favoriteAnimals->count() === 0)
                    <p class="mb-0 text-muted">Aún no tienes animales en favoritos.</p>
                @else
                    <div class="row g-3">
                        @foreach($favoriteAnimals as $a)
                            <div class="col-md-6">
                                <div class="kids-card p-3 h-100">
                                    <a class="rk-card-title" href="{{ route('animals.show', $a) }}">{{ $a->name }}</a>
                                    <div class="text-muted small mb-2">{{ $a->environment === 'mar' ? '🌊 Mar' : '🌳 Tierra' }} · {{ ucfirst($a->animal_type) }}</div>

                                    <a href="{{ route('animals.show', $a) }}" class="d-block">
                                        <img src="{{ $a->photo_url }}" class="rounded-4 w-100" style="height:160px;object-fit:cover;">
                                    </a>

                                    <form method="POST" action="{{ route('favorites.animal.toggle', $a) }}" class="mt-2">
                                        @csrf
                                        <button class="btn btn-outline-danger kids-pill w-100">💔 Quitar</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
