@extends('layouts.app-kids')
@section('title', $animal->name.' - RiojaKids')

@section('content')
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div>
            <h2 class="fw-bold mb-0">🦊 {{ $animal->name }}</h2>
            <div class="text-muted">
                {{ $animal->environment === 'mar' ? '🌊 Vive en el mar' : '🌳 Vive en la tierra' }} ·
                {{ ucfirst($animal->animal_type) }}
            </div>
        </div>

        <div class="d-flex gap-2">
            <a class="btn btn-outline-primary kids-pill" href="{{ route('animals.index') }}">← Volver</a>

            @auth
                <form method="POST" action="{{ route('favorites.animal.toggle', $animal) }}">
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
        <div class="col-lg-5">
            <div class="kids-card p-3">
                <img
                    src="{{ $animal->photo_url ?: 'https://placehold.co/800x600?text=Animal' }}"
                    alt="{{ $animal->name }}"
                    class="img-fluid rounded-4"
                    style="width:100%; height:360px; object-fit:cover;"
                >
            </div>
        </div>

        <div class="col-lg-7">
            <div class="kids-card p-4 mb-3 rk-sheet">
                <h4 class="fw-bold mb-3">📌 Ficha técnica</h4>

                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="rk-fact">🏡 <b>Hábitat</b>: {{ $animal->habitat ?: '—' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="rk-fact">🔬 <b>Nombre científico</b>: {{ $animal->scientific_name ?: '—' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="rk-fact">🍽️ <b>Alimentación</b>: {{ $animal->diet ?: '—' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="rk-fact">⏳ <b>Vida</b>: {{ $animal->lifespan_years ? $animal->lifespan_years.' años' : '—' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="rk-fact">📏 <b>Tamaño</b>: {{ $animal->size_cm ? $animal->size_cm.' cm' : '—' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="rk-fact">⚖️ <b>Peso</b>: {{ $animal->weight_kg ? $animal->weight_kg.' kg' : '—' }}</div>
                    </div>
                </div>
            </div>

            <div class="kids-card p-4">
                <h4 class="fw-bold mb-2">📖 ¿Cómo es {{ $animal->name }}?</h4>
                <p class="mb-0" style="font-size:1.05rem; line-height:1.6;">
                    {{ $animal->description ?: 'Próximamente añadiremos una descripción divertida para este animal 😊' }}
                </p>
            </div>
        </div>
    </div>
@endsection
