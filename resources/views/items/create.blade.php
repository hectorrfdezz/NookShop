@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Elemento</h1>
    <form action="{{ route('items.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title">Título</label>
            <input type="text" id="title" name="title" class="form-control" required value="{{ old('title') }}">
        </div>
        <div class="mb-3">
            <label for="description">Descripción</label>
            <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
