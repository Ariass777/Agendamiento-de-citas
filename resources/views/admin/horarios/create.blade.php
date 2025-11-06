@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Registro de un nuevo horario</h1>
</div>

<hr>

<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Complete los datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/horarios/create') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Estilista -->
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="usuario_id"><strong>Estilista</strong> <b>*</b></label>
                                <select name="usuario_id" id="usuario_id" class="form-control" required>
                                    <option value="" disabled selected>Seleccione un estilista</option>
                                    @foreach($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Día -->
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="dia"><strong>Día</strong> <b>*</b></label>
                                <select name="dia" id="dia" class="form-control" required>
                                    <option value="" disabled selected>Seleccione un día</option>
                                    <option value="LUNES">Lunes</option>
                                    <option value="MARTES">Martes</option>
                                    <option value="MIERCOLES">Miércoles</option>
                                    <option value="JUEVES">Jueves</option>
                                    <option value="VIERNES">Viernes</option>
                                    <option value="SABADO">Sábado</option>
                                    <option value="DOMINGO">Domingo</option>
                                </select>
                            </div>
                        </div>

                        <!-- Hora Inicio -->
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="hora_inicio"><strong>Hora de inicio</strong> <b>*</b></label>
                                <input 
                                    type="time" 
                                    name="hora_inicio" 
                                    id="hora_inicio" 
                                    class="form-control" 
                                    value="{{ old('hora_inicio') }}" 
                                    required
                                >
                                @error('hora_inicio')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Hora Final -->
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="hora_fin"><strong>Hora final</strong> <b>*</b></label>
                                <input 
                                    type="time" 
                                    name="hora_fin" 
                                    id="hora_fin" 
                                    class="form-control" 
                                    value="{{ old('hora_fin') }}" 
                                    required
                                >
                                @error('hora_fin')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="text-right">
                        <a href="{{ url('admin/usuarios') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
