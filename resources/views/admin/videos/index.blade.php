@extends('layouts.admin')
@section('title', 'Admin Vídeos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold mb-0">🛠 Admin · Vídeos</h2>
        <a class="btn btn-primary kids-pill" href="{{ route('admin.videos.create') }}">➕ Nuevo</a>
    </div>

    <div class="kids-card p-3">
        @if($videos->count() === 0)
            <p class="mb-0">Aún no hay vídeos. Pulsa <b>Nuevo</b> para añadir uno.</p>
        @else
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                    <tr>
                        <th>Título</th>
                        <th>YouTube ID</th>
                        <th>Categoría</th>
                        <th>Edad</th>
                        <th>Destacado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($videos as $v)
                        <tr>
                            <td class="fw-bold">{{ $v->title }}</td>
                            <td><code>{{ $v->youtube_id }}</code></td>
                            <td>{{ $v->category }}</td>
                            <td>{{ $v->age_group }}</td>
                            <td>{{ $v->featured ? '⭐ Sí' : '—' }}</td>
                            <td class="text-end">
                                <a class="btn btn-outline-secondary btn-sm kids-pill" href="{{ route('admin.videos.edit', $v) }}">Editar</a>
                                <form class="d-inline" method="POST" action="{{ route('admin.videos.destroy', $v) }}">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm kids-pill" onclick="return confirm('¿Borrar vídeo?')">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
