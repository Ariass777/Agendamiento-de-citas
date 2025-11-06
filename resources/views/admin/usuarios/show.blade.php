@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Usuario: {{ $usuario->name }}</h1>
</div>

<hr>

<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos registrados</h3>
            </div>

            <div class="card-body">
                {{-- Nombre --}}
                <div class="mb-3">
                    <label><b>Nombre:</b></label>
                    <p>{{ $usuario->name }}</p>
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label><b>Email:</b></label>
                    <p>{{ $usuario->email }}</p>
                </div>

                {{-- Servicios --}}
                <div class="mb-3">
                    <label><b>Servicios:</b></label>
                    <ul>
                        @foreach($usuario->servicios as $servicio)
                            <li>{{ $servicio->nombre }}</li>
                        @endforeach
                    </ul>
                </div>

                <hr>
                <a href="{{ url('admin/usuarios') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
