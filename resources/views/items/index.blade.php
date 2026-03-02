@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Elementos</h1>
    <a href="{{ route('items.create') }}" class="btn btn-success mb-3">Crear nuevo</a>
    @if($items->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <a href="{{ route('items.show', $item) }}" class="btn btn-primary btn-sm">Ver</a>
                            <a href="{{ route('items.edit', $item) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
    @else
        <p>No hay elementos.</p>
    @endif
</div>
@endsection
