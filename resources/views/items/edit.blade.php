@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Elemento</h1>
    <form action="{{ route('items.update', $item) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title">Título</label>
            <input type="text" id="title" name="title" class="form-control" required value="{{ old('title', $item->title) }}">
        </div>
        <div class="mb-3">
            <label for="description">Descripción</label>
            <textarea id="description" name="description" class="form-control">{{ old('description', $item->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
