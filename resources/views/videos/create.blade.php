@extends('layouts.app-kids')
@section('title', 'Crear vídeo')

@section('content')
    <h2 class="fw-bold mb-3">➕ Crear vídeo</h2>

    <div class="kids-card p-3">
        <form method="POST" action="{{ route('admin.videos.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Título</label>
                <input class="form-control kids-pill" name="title" required>
            </div>

            <div class="mb-3">
                <label class="form-label">YouTube ID</label>
                <input class="form-control kids-pill" name="youtube_id" placeholder="Ej: dQw4w9WgXcQ" required>
                <div class="text-muted small mt-1">Es el texto que aparece después de <code>v=</code> en YouTube.</div>
            </div>

            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label">Categoría</label>
                    <input class="form-control kids-pill" name="category" value="Aprender" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Edad</label>
                    <input class="form-control kids-pill" name="age_group" value="6-8" required>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button class="btn btn-primary kids-pill">Guardar</button>
                <a class="btn btn-outline-secondary kids-pill" href="{{ route('admin.videos.index') }}">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
