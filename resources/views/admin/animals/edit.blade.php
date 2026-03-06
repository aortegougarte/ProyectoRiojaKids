@extends('layouts.admin')
@section('title', 'Editar animal')

@section('content')
    <h2 class="fw-bold mb-3">✏️ Editar animal</h2>

    <div class="kids-card p-3">
        <form action="{{ route('admin.animals.update', $animal->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control kids-pill" name="name" value="{{ $animal->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">URL foto</label>
                <input class="form-control kids-pill" name="photo_url" value="{{ $animal->photo_url }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">¿Vive en...?</label>
                <select class="form-select kids-pill" name="environment" required>
                    <option value="tierra" @selected($animal->environment==='tierra')>🌳 Tierra</option>
                    <option value="mar" @selected($animal->environment==='mar')>🌊 Mar</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <select class="form-select kids-pill" name="animal_type" required>
                    <option value="mamifero" @selected($animal->animal_type==='mamifero')>🦁 Mamífero</option>
                    <option value="reptil" @selected($animal->animal_type==='reptil')>🦎 Reptil</option>
                    <option value="anfibio" @selected($animal->animal_type==='anfibio')>🐸 Anfibio</option>
                    <option value="ave" @selected($animal->animal_type==='ave')>🦉 Ave</option>
                    <option value="pez" @selected($animal->animal_type==='pez')>🐟 Pez</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Hábitat (ej: Bosque, Desierto, Arrecife...)</label>
                <input class="form-control kids-pill" name="habitat" value="{{ $animal->habitat }}" required>
            </div>

            <div class="row g-2">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nombre científico (opcional)</label>
                        <input class="form-control kids-pill" name="scientific_name" value="{{ $animal->scientific_name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Alimentación (opcional)</label>
                        <input class="form-control kids-pill" name="diet" value="{{ $animal->diet }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Vida (años)</label>
                        <input class="form-control kids-pill" name="lifespan_years" type="number" min="0" value="{{ $animal->lifespan_years }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Tamaño (cm)</label>
                        <input class="form-control kids-pill" name="size_cm" type="number" min="0" value="{{ $animal->size_cm }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Peso (kg)</label>
                        <input class="form-control kids-pill" name="weight_kg" type="number" step="0.01" min="0" value="{{ $animal->weight_kg }}">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" rows="4" name="description">{{ $animal->description }}</textarea>
            </div>

            <button class="btn btn-primary kids-pill">Guardar cambios</button>
            <a class="btn btn-outline-secondary kids-pill" href="{{ route('admin.animals.index') }}">Cancelar</a>
        </form>
    </div>
@endsection
