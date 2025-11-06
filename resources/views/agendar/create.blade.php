<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar tu cita | Silvia Peluquería</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #121212;
            color: #E0E0E0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header-title {
            color: #D4AF37;
            font-weight: 700;
            text-shadow: 0 0 5px rgba(212, 175, 55, 0.5);
        }
        .text-muted { color: #AAAAAA !important; }
        .card-elegant {
            border: 1px solid #333;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            background-color: #1c1c1c;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            background-color: #2c2c2c;
            border: 1px solid #444;
            color: #E0E0E0;
        }
        .form-control:focus, .form-select:focus {
            background-color: #383838;
            border-color: #D4AF37;
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
        }
        label {
            font-weight: 500;
            color: #D4AF37;
            margin-bottom: .5rem;
        }
        .btn-primary-custom {
            background-color: #7d4833;
            border-color: #5a3324;
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 8px;
            color: white;
            padding: 12px 24px;
        }
        .btn-primary-custom:hover {
            background-color: #92543e;
            border-color: #D4AF37;
            transform: translateY(-1px);
        }
        .btn-warning-custom {
            background-color: #f39c12;
            border-color: #e67e22;
            color: #fff;
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 12px 24px;
        }
        .btn-warning-custom:hover {
            background-color: #e67e22;
            border-color: #c0392b;
        }
        .btn-outline-secondary {
            color: #AAAAAA;
            border-color: #444;
            background-color: transparent;
        }
        .btn-outline-secondary:hover {
            color: #fff;
            border-color: #D4AF37;
            background-color: #333;
        }
    </style>

    {{-- Script para cargar estilistas dinámicamente --}}
    <script>
        $(document).ready(function() {
            $('#servicio').on('change', function() {
                const servicioId = $(this).val();
                const estilistaSelect = $('#estilista');
                estilistaSelect.html('<option value="">Cargando...</option>');

                if (servicioId) {
                    $.ajax({
                        url: `/servicios/${servicioId}/estilistas`,
                        type: 'GET',
                        success: function(data) {
                            estilistaSelect.empty().append('<option value="">Seleccione un estilista</option>');
                            if (data.length > 0) {
                                data.forEach(e => estilistaSelect.append(`<option value="${e.id}">${e.name}</option>`));
                            } else {
                                estilistaSelect.append('<option value="">No hay estilistas para este servicio</option>');
                            }
                        },
                        error: function() {
                            estilistaSelect.html('<option value="">Error al cargar</option>');
                        }
                    });
                } else {
                    estilistaSelect.html('<option value="">Seleccione un estilista</option>');
                }
            });
        });
    </script>
</head>
<body>

<div class="container mt-5">
    <div class="text-center mb-5">
        <h2 class="header-title">Reserva tu cita en Silvia Peluquería 💇‍♀️</h2>
        <p class="text-muted">Selecciona tu servicio, estilista, día y hora para agendar tu cita.</p>
    </div>

    {{-- 🔔 Mensajes de éxito o error --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <div class="card card-elegant mx-auto" style="max-width: 700px;">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('agendar.store') }}" method="POST" id="formAgendar">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="servicio">Servicio</label>
                        <select name="servicio_id" id="servicio" class="form-select" required>
                            <option value="">Seleccione un servicio</option>
                            @foreach($servicios as $servicio)
                                <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="estilista">Estilista</label>
                        <select name="empleado_id" id="estilista" class="form-select" required>
                            <option value="">Seleccione un estilista</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="dia">Día disponible <span class="text-danger">*</span></label>
                        <select name="fecha" id="dia" class="form-select" required>
                            <option value="">Selecciona un estilista primero</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="hora">Hora disponible <span class="text-danger">*</span></label>
                        <select name="hora" id="hora" class="form-select" required>
                            <option value="">-- Selecciona una hora --</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="celular">Celular</label>
                    <input type="text" id="celular" name="celular" class="form-control" placeholder="Ej: 3201234567" required>
                </div>

                <div class="text-center mt-4">
                    @auth
                        <button type="submit" class="btn btn-primary-custom btn-lg w-75">
                            Confirmar reserva
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-warning-custom btn-lg w-75">
                            Inicia sesión para confirmar tu cita
                        </a>
                    @endauth
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('agendar.index') }}" class="btn btn-outline-secondary">
                        ← Volver al inicio
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- Script para cargar días y horas disponibles --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectEstilista = document.getElementById('estilista');
    const selectDia = document.getElementById('dia');
    const selectHora = document.getElementById('hora');

    // 🔹 Cargar días disponibles
    selectEstilista.addEventListener('change', function() {
        const usuarioId = this.value;
        selectDia.innerHTML = '<option value="">Cargando días...</option>';
        selectHora.innerHTML = '<option value="">Selecciona un día primero</option>';

        if (!usuarioId) {
            selectDia.innerHTML = '<option value="">Selecciona un estilista primero</option>';
            return;
        }

        fetch(`/get-dias/${usuarioId}`)
            .then(res => res.json())
            .then(dias => {
                selectDia.innerHTML = '<option value="">Selecciona un día</option>';
                dias.length > 0
                    ? dias.forEach(d => selectDia.innerHTML += `<option value="${d}">${d}</option>`)
                    : selectDia.innerHTML = '<option value="">No hay días disponibles</option>';
            })
            .catch(() => selectDia.innerHTML = '<option value="">Error al cargar los días</option>');
    });

    // 🔹 Cargar horas disponibles
    selectDia.addEventListener('change', function() {
        const usuarioId = selectEstilista.value;
        const dia = this.value;
        selectHora.innerHTML = '<option value="">Cargando horas...</option>';

        if (!usuarioId || !dia) {
            selectHora.innerHTML = '<option value="">Selecciona una hora</option>';
            return;
        }

        fetch(`/get-horas/${usuarioId}/${dia}`)
            .then(res => res.json())
            .then(horas => {
                selectHora.innerHTML = '<option value="">Selecciona una hora</option>';
                horas.length > 0
                    ? horas.forEach(h => selectHora.innerHTML += `<option value="${h}">${h}</option>`)
                    : selectHora.innerHTML = '<option value="">No hay horas disponibles</option>';
            })
            .catch(() => selectHora.innerHTML = '<option value="">Error al cargar las horas</option>');
    });
});
</script>

</body>
</html>
