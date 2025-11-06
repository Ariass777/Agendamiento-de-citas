@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Registrar un nuevo usuario</h1>
</div>

<hr>

<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Complete los datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('admin/usuarios') }}" method="POST">
                    @csrf

                    {{-- Nombre --}}
                    <div class="form-group mb-3">
                        <label>Nombre <b>*</b></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group mb-3">
                        <label>Email <b>*</b></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Servicios --}}
                    <div class="form-group mb-3">
                        <label>Servicios <b>*</b></label>
                        <select name="servicios[]" class="form-control" multiple required>
                            @foreach($servicios as $servicio)
                                <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Mantén presionado CTRL (o CMD en Mac) para seleccionar varios servicios.</small>
                        @error('servicios') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Contraseña --}}
                    <div class="form-group mb-3">
                        <label>Contraseña <b>*</b></label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Confirmar contraseña --}}
                    <div class="form-group mb-3">
                        <label>Confirmar Contraseña <b>*</b></label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                        @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="{{ url('admin/usuarios') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
