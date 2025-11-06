@extends('layouts.app')

@section('content')
<div class="container">
    <div class="reset-box">
        <h4 class="text-center mb-4">Restablecer La Contraseña</h4>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <!-- Campo oculto con el token -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Correo Electrónico -->
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input id="email" type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') ?? $email ?? '' }}" 
                       required autocomplete="email" autofocus 
                       placeholder="">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Nueva Contraseña -->
            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña</label>
                <input id="password" type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="new-password" 
                       placeholder="">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Repetir Contraseña -->
            <div class="mb-3">
                <label for="password-confirm" class="form-label">Repetir Contraseña</label>
                <input id="password-confirm" type="password" 
                       class="form-control" 
                       name="password_confirmation" required 
                       autocomplete="new-password" 
                       placeholder="">
            </div>

            <!-- Botón -->
            <div class="d-grid">
                <button type="submit" class="btn btn-orange">
                    Restablecer Contraseña
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Estilos adicionales --}}
<style>
    body {
        background-color: #f9f9f9;
    }
    .reset-box {
        max-width: 400px;
        margin: 80px auto;
        padding: 25px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .btn-orange {
        background-color: #ff9800;
        color: #fff;
        font-weight: bold;
    }
    .btn-orange:hover {
        background-color: #e68900;
        color: #fff;
    }
</style>
@endsection




