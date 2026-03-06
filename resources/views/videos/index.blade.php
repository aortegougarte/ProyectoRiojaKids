@extends('layouts.app-kids')
@section('title', 'Vídeos educativos - RiojaKids')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="fw-bold mb-0">🎓 Vídeos educativos</h2>
    </div>

    <form class="row g-2 mb-3">
        <div class="col-md-4">
            <input class="form-control kids-pill" name="category" value="{{ $category }}" placeholder="Categoría (Aprender, Música...)">
        </div>
        <div class="col-md-3">
            <input class="form-control kids-pill" name="age" value="{{ $age }}" placeholder="Edad (3-5, 6-8...)">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100 kids-pill">Filtrar</button>
        </div>
        <div class="col-md-3">
            <a class="btn btn-outline-secondary w-100 kids-pill" href="{{ route('videos.index') }}">Limpiar</a>
        </div>
    </form>

    @if($videos->count() === 0)
        <div class="kids-card p-3">
            Aún no hay vídeos. Si eres admin, añade alguno en <code>/admin/videos</code>.
        </div>
    @else
        <div class="row g-3">
            @foreach($videos as $v)
                <div class="col-md-4">
                    <div class="kids-card p-3 h-100">
                        <a class="rk-card-title" href="{{ route('videos.show', $v) }}">{{ $v->title }}</a>
                        <div class="text-muted small">🏷 {{ $v->category }} · 👶 {{ $v->age_group }}</div>

                        <a class="d-block mt-3" href="{{ route('videos.show', $v) }}">
                            <img
                                class="img-fluid rounded-4"
                                style="width:100%; height:210px; object-fit:cover;"
                                src="https://img.youtube.com/vi/{{ $v->youtube_id }}/hqdefault.jpg"
                                alt="{{ $v->title }}">
                        </a>

                        @if($v->description)
                            <p class="mt-3 mb-2 text-muted">{{ \Illuminate\Support\Str::limit($v->description, 110) }}</p>
                        @endif

                        <a class="btn btn-outline-primary kids-pill w-100 mb-2" href="{{ route('videos.show', $v) }}">▶️ Ver vídeo</a>
                        @auth
                            <form method="POST" action="{{ route('favorites.video.toggle', $v) }}" class="mt-2">
                                @csrf

                                @if(in_array($v->id, $favoriteVideoIds))
                                    <button class="btn btn-danger kids-pill w-100">
                                        💔 Quitar de favoritos
                                    </button>
                                @else
                                    <button class="btn btn-outline-danger kids-pill w-100">
                                        ❤️ Añadir a favoritos
                                    </button>
                                @endif

                            </form>
                        @else
                            <div class="mt-2 text-muted small">
                                Inicia sesión para guardar favoritos ❤️
                            </div>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            {{ $videos->withQueryString()->links() }}
        </div>
    @endif
@endsection
