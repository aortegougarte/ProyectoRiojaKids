@extends('layouts.app-kids')
@section('title', 'Animales - Riojakids')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="fw-bold mb-0">🦊 Animales</h2>
    </div>

    <form class="row g-2 mb-3">
        <div class="col-md-6">
            <input class="form-control kids-pill" name="q" value="{{ $q ?? '' }}" placeholder="Buscar por nombre o hábitat...">
        </div>
        <div class="col-md-3">
            <select class="form-select kids-pill" name="type">
                <option value="">🐾 Todos los tipos</option>
                <option value="mamifero" @selected(($type ?? '')==='mamifero')>🦁 Mamíferos</option>
                <option value="reptil" @selected(($type ?? '')==='reptil')>🦎 Reptiles</option>
                <option value="anfibio" @selected(($type ?? '')==='anfibio')>🐸 Anfibios</option>
                <option value="ave" @selected(($type ?? '')==='ave')>🦉 Aves</option>
                <option value="pez" @selected(($type ?? '')==='pez')>🐟 Peces</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select kids-pill" name="environment">
                <option value="">🌎 Tierra y mar</option>
                <option value="tierra" @selected(($environment ?? '')==='tierra')>🌳 Tierra</option>
                <option value="mar" @selected(($environment ?? '')==='mar')>🌊 Mar</option>
            </select>
        </div>
        <div class="col-md-1">
            <button class="btn btn-primary w-100 kids-pill">Buscar</button>
        </div>
    </form>

    @if($animals->count() === 0)
        <div class="kids-card p-3">
            No hay animales todavía.
            @auth
                @if(auth()->user()->role === 'admin')
                    Puedes añadir en <code>/admin/animales</code>.
                @endif
            @endauth
        </div>
    @else
        <div class="row g-3">
            @foreach($animals as $a)
                <div class="col-md-4">
                    <div class="kids-card p-3 h-100">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <a class="rk-card-title" href="{{ route('animals.show', $a) }}">{{ $a->name }}</a>
                                <div class="text-muted small">
                                    {{ $a->environment === 'mar' ? '🌊 Mar' : '🌳 Tierra' }} · {{ ucfirst($a->animal_type) }}
                                </div>
                            </div>
                        </div>

                        <a class="mt-3 d-block" href="{{ route('animals.show', $a) }}">
                            <img
                                src="{{ $a->photo_url ?: 'https://placehold.co/600x400?text=Animal' }}"
                                alt="{{ $a->name }}"
                                class="img-fluid rounded-4"
                                style="width:100%; height:220px; object-fit:cover;"
                            >
                        </a>

                        <br>

                        <a class="btn btn-outline-primary kids-pill w-100 mb-2" href="{{ route('animals.show', $a) }}">📘 Ver ficha</a>

                        @auth
                            <form method="POST" action="{{ route('favorites.animal.toggle', $a) }}" class="mt-auto">
                                @csrf

                                @php $isFav = in_array($a->id, $favoriteAnimalIds ?? []); @endphp

                                @if($isFav)
                                    <button class="btn btn-danger kids-pill w-100">💔 Quitar de favoritos</button>
                                @else
                                    <button class="btn btn-outline-danger kids-pill w-100">❤️ Añadir a favoritos</button>
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
            {{ $animals->withQueryString()->links() }}
        </div>
    @endif
@endsection
