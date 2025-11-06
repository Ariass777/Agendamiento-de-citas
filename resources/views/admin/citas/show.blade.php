@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">📋 Detalles de la Cita #{{ $cita->id }}</h2>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-body">
            <!-- Datos de cliente y empleado -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>👤 Cliente:</strong> {{ $cita->cliente->nombres ?? 'N/A' }} {{ $cita->cliente->apellidos ?? '' }}
                </div>
                <div class="col-md-6">
                    <strong>💇‍♂️ Empleado:</strong> {{ $cita->empleado->name ?? 'N/A' }}
                </div>
            </div>

            <!-- Servicio y contacto -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>🧴 Servicio:</strong> {{ $cita->servicio }}
                </div>
                <div class="col-md-6">
                    <strong>📱 Celular:</strong> {{ $cita->celular }}
                    @if($cita->celular)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $cita->celular) }}?text={{ urlencode('Hola '.$cita->cliente->nombres.', te contactamos desde el salón para confirmar tu cita el '.$cita->fecha.' a las '.$cita->hora_inicio.'. ¡Te esperamos! 💇‍♀️✨') }}" 
                           target="_blank" 
                           class="btn btn-success btn-sm ms-2">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                    @endif
                </div>
            </div>

            <!-- Fecha y horario -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>📅 Fecha:</strong> {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                </div>
                <div class="col-md-4">
                    <strong>🕐 Hora Inicio:</strong> {{ $cita->hora_inicio }}
                </div>
                <div class="col-md-4">
                    <strong>🕒 Hora Fin:</strong> {{ $cita->hora_fin }}
                </div>
            </div>

            <div class="mb-3">
                <strong>⏱ Duración:</strong> {{ $cita->duracion_minutos }} minutos
            </div>

            <div class="mb-3">
                <strong>📌 Estado actual:</strong>
                <span class="badge 
                    @if($cita->estado == 'pendiente') bg-warning 
                    @elseif($cita->estado == 'confirmada') bg-success 
                    @elseif($cita->estado == 'cancelada') bg-danger 
                    @else bg-secondary @endif">
                    {{ ucfirst($cita->estado) }}
                </span>
            </div>

            <!-- Formulario de actualización -->
            <form action="{{ route('admin.citas.update', $cita->id) }}" method="POST" class="mt-3">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="estado" class="form-label fw-bold">Cambiar Estado:</label>
                    <select name="estado" id="estado" class="form-select" required>
                        <option value="pendiente" {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="confirmada" {{ $cita->estado == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                        <option value="completada" {{ $cita->estado == 'completada' ? 'selected' : '' }}>Completada</option>
                        <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">💾 Actualizar Estado</button>
                <a href="{{ route('admin.citas.index') }}" class="btn btn-secondary">⬅ Volver</a>
            </form>
        </div>
    </div>
</div>
@endsection
