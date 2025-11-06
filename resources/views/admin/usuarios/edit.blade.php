@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Modificar usuario: {{ $usuario->name }}</h1>
</div>

<hr>

<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Complete los datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('admin/usuarios', $usuario->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div class="form-group mb-3">
                        <label>Nombre <b>*</b></label>
                        <input type="text" name="name" value="{{ $usuario->name }}" class="form-control" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group mb-3">
                        <label>Email <b>*</b></label>
                        <input type="email" name="email" value="{{ $usuario->email }}" class="form-control" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Servicios --}}
                    <div class="form-group mb-3">
                        <label>Servicios <b>*</b></label>
                        <select name="servicios[]" class="form-control" multiple required>
                            @foreach($servicios as $servicio)
                                <option value="{{ $servicio->id }}"
                                    {{ in_array($servicio->id, $usuario->servicios->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $servicio->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Mantén presionado CTRL (o CMD) para seleccionar varios servicios.</small>
                    </div>

                    {{-- Contraseña --}}
                    <div class="form-group mb-3">
                        <label>Contraseña (opcional)</label>
                        <input type="password" name="password" class="form-control">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Confirmar contraseña --}}
                    <div class="form-group mb-3">
                        <label>Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="{{ url('admin/usuarios') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
