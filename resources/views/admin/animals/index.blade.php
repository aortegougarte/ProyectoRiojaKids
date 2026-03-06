@extends('layouts.admin')
@section('title', 'Admin Animales')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold mb-0">🛠 Admin · Animales</h2>
        <a class="btn btn-primary kids-pill" href="{{ route('admin.animals.create') }}">➕ Nuevo</a>
    </div>

    <div class="kids-card p-3">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Zona</th>
                    <th>Tipo</th>
                    <th>Hábitat</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($animals as $a)
                    <tr>
                        <td style="width:90px">
                            <img src="{{ $a->photo_url }}" class="rounded-4" style="width:70px;height:70px;object-fit:cover;">
                        </td>
                        <td class="fw-bold">{{ $a->name }}</td>
                        <td>{{ $a->environment === 'mar' ? '🌊 Mar' : '🌳 Tierra' }}</td>
                        <td>{{ ucfirst($a->animal_type) }}</td>
                        <td>{{ $a->habitat }}</td>
                        <td class="text-end">
                            <a class="btn btn-outline-secondary btn-sm kids-pill" href="{{ route('admin.animals.edit', $a) }}">Editar</a>
                            <form class="d-inline" method="POST" action="{{ route('admin.animals.destroy', $a) }}">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm kids-pill" onclick="return confirm('¿Borrar?')">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
