@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Verifica tu correo electrónico</h1>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @else
        <p>Se ha enviado un enlace de verificación a tu dirección de correo. Por favor, revisa tu bandeja de entrada y sigue las instrucciones para activar tu cuenta.</p>
    @endif
    <p>Si no has recibido el correo, puedes solicitar uno nuevo.</p>
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Reenviar enlace de verificación</button>
    </form>
</div>
@endsection