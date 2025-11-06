@extends('layouts.app')

@section('title', 'Editar cita - El Edén Barbershop')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Tarjeta principal -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center rounded-top-4">
                    <h3 class="mb-0">Editar tu cita</h3>
                    <small>Modifica los datos o elimina la cita si no podrás asistir</small>
                </div>

                <div class="card-body bg-light">
                    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre completo</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $reserva->nombre) }}" required>
                        </div>

                        <!-- Servicio -->
                        <div class="mb-3">
                            <label for="servicio" class="form-label fw-bold">Servicio</label>
                            <select name="servicio" id="servicio" class="form-select" required>
                                <option value="">Seleccione un servicio</option>
                                <option value="Corte de cabello" {{ $reserva->servicio == 'Corte de cabello' ? 'selected' : '' }}>Corte de cabello</option>
                                <option value="Afeitado" {{ $reserva->servicio == 'Afeitado' ? 'selected' : '' }}>Afeitado</option>
                                <option value="Tinte" {{ $reserva->servicio == 'Tinte' ? 'selected' : '' }}>Tinte</option>
                                <option value="Perfilado de cejas" {{ $reserva->servicio == 'Perfilado de cejas' ? 'selected' : '' }}>Perfilado de cejas</option>
                            </select>
                        </div>

                        <!-- Fecha -->
                        <div class="mb-3">
                            <label for="fecha" class="form-label fw-bold">Fecha</label>
                            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', $reserva->fecha) }}" required>
                        </div>

                        <!-- Hora -->
                        <div class="mb-3">
                            <label for="hora" class="form-label fw-bold">Hora</label>
                            <input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora', $reserva->hora) }}" required>
                        </div>

                        <!-- Botones de acción -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('reservas.index') }}" class="btn btn-secondary px-4">⬅ Volver</a>

                            <div>
                                <button type="submit" class="btn btn-primary px-4 me-2">
                                    💾 Actualizar
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Eliminar cita -->
                    <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" class="mt-3 text-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('¿Seguro que deseas eliminar esta cita?')">
                            🗑 Eliminar cita
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- 🛍️ Sección tienda de productos -->
<section class="container text-center my-5">
    <h2 class="text-warning fw-bold mb-4">Descubre Nuestros Productos Capilares</h2>
    <a href="{{ route('productos.index') }}" class="text-decoration-none">
        <div class="card border-0 shadow-lg bg-dark text-light rounded-4 overflow-hidden mx-auto" style="max-width: 700px; transition: transform 0.3s;">
            <img src="{{ asset('images/productos_cabello.jpg') }}" alt="Productos para el cabello" class="card-img-top" style="height: 350px; object-fit: cover;">
            <div class="card-body">
                <h4 class="text-warning fw-bold">Cuidado y estilo profesional para tu cabello</h4>
                <p>Explora nuestra tienda en línea y encuentra los mejores productos de belleza y tratamiento capilar.</p>
                <button class="btn btn-warning fw-bold px-4 py-2 mt-2">🛒 Ver Productos</button>
            </div>
        </div>
    </a>
</section>
@endsection
