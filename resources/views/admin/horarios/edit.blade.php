@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Editar horario</h1>
</div>

<hr>

<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Actualiza los datos del horario</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.horarios.update', $horario->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Estilista -->
                        <div class="col-md-4 mb-3">
                            <label for="usuario_id"><strong>Estilista</strong> <b>*</b></label>
                           <select name="usuario_id" id="usuario_id" class="form-control" required>
    @foreach($usuarios as $usuario)
        <option value="{{ $usuario->id }}" {{ $usuario->id == $horario->usuario_id ? 'selected' : '' }}>
            {{ $usuario->name }}
        </option>
    @endforeach
</select>

                        </div>

                        <!-- Día -->
                        <div class="col-md-4 mb-3">
                            <label for="dia"><strong>Día</strong> <b>*</b></label>
                            <select name="dia" id="dia" class="form-control" required>
                                @foreach(['LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO'] as $dia)
                                    <option value="{{ $dia }}" {{ $horario->dia == $dia ? 'selected' : '' }}>
                                        {{ ucfirst(strtolower($dia)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Hora inicio -->
                        <div class="col-md-4 mb-3">
                            <label for="hora_inicio"><strong>Hora de inicio</strong> <b>*</b></label>
                            <input type="time" name="hora_inicio" class="form-control" value="{{ $horario->hora_inicio }}" required>
                        </div>

                        <!-- Hora fin -->
                        <div class="col-md-4 mb-3">
                            <label for="hora_fin"><strong>Hora final</strong> <b>*</b></label>
                            <input type="time" name="hora_fin" class="form-control" value="{{ $horario->hora_fin }}" required>
                        </div>
                    </div>

                    <hr>

                    <div class="text-right">
                        <a href="{{ route('admin.horarios.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
