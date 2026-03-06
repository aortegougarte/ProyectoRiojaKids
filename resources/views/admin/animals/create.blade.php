@extends('layouts.admin')
@section('title', 'Crear animal')

@section('content')
    <h2 class="fw-bold mb-3">➕ Crear animal</h2>

    <div class="kids-card p-3">
        <form method="POST" action="{{ route('admin.animals.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control kids-pill" name="name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">URL foto</label>
                <input class="form-control kids-pill" name="photo_url" required>
            </div>

            <div class="mb-3">
                <label class="form-label">¿Vive en...?</label>
                <select class="form-select kids-pill" name="environment" required>
                    <option value="tierra" selected>🌳 Tierra</option>
                    <option value="mar">🌊 Mar</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <select class="form-select kids-pill" name="animal_type" required>
                    <option value="mamifero" selected>🦁 Mamífero</option>
                    <option value="reptil">🦎 Reptil</option>
                    <option value="anfibio">🐸 Anfibio</option>
                    <option value="ave">🦉 Ave</option>
                    <option value="pez">🐟 Pez</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Hábitat (ej: Bosque, Desierto, Arrecife...)</label>
                <input class="form-control kids-pill" name="habitat" value="Bosque" required>
            </div>

            <div class="row g-2">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nombre científico (opcional)</label>
                        <input class="form-control kids-pill" name="scientific_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Alimentación (opcional)</label>
                        <input class="form-control kids-pill" name="diet" placeholder="Herbívoro, carnívoro...">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Vida (años)</label>
                        <input class="form-control kids-pill" name="lifespan_years" type="number" min="0">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Tamaño (cm)</label>
                        <input class="form-control kids-pill" name="size_cm" type="number" min="0">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Peso (kg)</label>
                        <input class="form-control kids-pill" name="weight_kg" type="number" step="0.01" min="0">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" rows="4" name="description"></textarea>
            </div>

            <button class="btn btn-primary kids-pill">Guardar</button>
            <a class="btn btn-outline-secondary kids-pill" href="{{ route('admin.animals.index') }}">Cancelar</a>
        </form>
    </div>
@endsection
