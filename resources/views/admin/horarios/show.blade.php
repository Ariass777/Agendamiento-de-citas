@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Datos del horario</h1>
</div>

<hr>

<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos registrados</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Estilista -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label><strong>Estilista:</strong></label>
                            <p>{{ $horario->usuario->name }}</p>
                        </div>
                    </div>

                    <!-- Día -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label><strong>Día:</strong></label>
                            <p>{{ $horario->dia }}</p>
                        </div>
                    </div>

                    <!-- Hora Inicio -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label><strong>Hora de inicio:</strong></label>
                            <p>{{ $horario->hora_inicio }}</p>
                        </div>
                    </div>

                    <!-- Hora Fin -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label><strong>Hora final:</strong></label>
                            <p>{{ $horario->hora_fin }}</p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="text-right">
                    <a href="{{ route('admin.horarios.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
