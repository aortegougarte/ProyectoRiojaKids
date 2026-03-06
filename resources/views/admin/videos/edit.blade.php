@extends('layouts.admin')
@section('title', 'Editar vídeo')

@section('content')
    <h2 class="fw-bold mb-3">✏️ Editar vídeo</h2>

    <div class="kids-card p-3">
        <form method="POST" action="{{ route('admin.videos.update', $video) }}">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Título</label>
                <input class="form-control kids-pill" name="title" value="{{ $video->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">YouTube ID</label>
                <input class="form-control kids-pill" name="youtube_id" value="{{ $video->youtube_id }}" required>
            </div>

            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label">Categoría</label>
                    <input class="form-control kids-pill" name="category" value="{{ $video->category }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Edad</label>
                    <input class="form-control kids-pill" name="age_group" value="{{ $video->age_group }}" required>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Descripción (opcional)</label>
                <textarea class="form-control" rows="4" name="description">{{ $video->description }}</textarea>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="1" id="featured" name="featured" @checked($video->featured)>
                <label class="form-check-label" for="featured">Mostrar como destacado</label>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button class="btn btn-primary kids-pill">Guardar cambios</button>
                <a class="btn btn-outline-secondary kids-pill" href="{{ route('admin.videos.index') }}">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
