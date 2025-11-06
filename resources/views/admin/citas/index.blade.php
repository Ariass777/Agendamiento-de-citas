@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">📅 Listado de Citas</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($citas->isEmpty())
        <div class="alert alert-info">No hay citas registradas aún.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Empleado</th>
                        <th>Servicio</th>
                        <th>Celular</th>
                        <th>Fecha</th>
                        <th>Hora Inicio</th>
                        <th>Duración</th>
                        <th>Hora Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                        <tr class="text-center">
                            <td>{{ $cita->id }}</td>
                            <td>{{ $cita->cliente->nombres ?? 'N/A' }}</td>
                            <td>{{ $cita->empleado->name ?? 'N/A' }}</td>
                            <td>{{ $cita->servicio }}</td>
                            <td>{{ $cita->celular }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                            <td>{{ $cita->hora_inicio }}</td>
                            <td>{{ $cita->duracion_minutos }} min</td>
                            <td>{{ $cita->hora_fin }}</td>
                            <td>
                                <span class="badge 
                                    @if($cita->estado == 'pendiente') bg-warning 
                                    @elseif($cita->estado == 'confirmada') bg-success 
                                    @elseif($cita->estado == 'cancelada') bg-danger 
                                    @else bg-secondary @endif">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.citas.show', $cita->id) }}" class="btn btn-info btn-sm">
                                    Ver
                                </a>

                                <!-- Formulario para eliminar -->
                                <form action="{{ route('admin.citas.destroy', $cita->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('¿Seguro que deseas eliminar esta cita?')">
                                        Eliminar
                                    </button>
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
