@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Listado de usuarios</h1>
</div>

<hr>

<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Usuarios registrados</h3>

                <div class="card-tools">
                    <a href="{{ url('admin/usuarios/create') }}" class="btn btn-primary">
                        Registrar nuevo
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                    <thead style="background-color: #c0c0c0;">
                        <tr>
                            <th style="text-align: center">#</th>
                            <th style="text-align: center">Nombre</th>
                            <th style="text-align: center">Email</th>
                            <th style="text-align: center">Servicios</th>
                            <th style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $index => $usuario)
                            <tr>
                                <td style="text-align: center">{{ $index + 1 }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @if($usuario->servicios->count() > 0)
                                        <ul style="margin: 0; padding-left: 15px;">
                                            @foreach($usuario->servicios as $servicio)
                                                <li>{{ $servicio->nombre }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">Sin servicios</span>
                                    @endif
                                </td>
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <a href="{{ url('admin/usuarios/' . $usuario->id) }}" class="btn btn-info btn-sm" title="Ver"><i class="bi bi-eye"></i></a>
                                        <a href="{{ url('admin/usuarios/' . $usuario->id . '/edit') }}" class="btn btn-success btn-sm" title="Editar"><i class="bi bi-pencil"></i></a>
                                        <a href="{{ url('admin/usuarios/' . $usuario->id . '/confirm-delete') }}" class="btn btn-danger btn-sm" title="Eliminar"><i class="bi bi-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Script DataTables --}}
                <script>
                    $(function () {
                        $("#example1").DataTable({
                            "pageLength": 10,
                            "language": {
                                "emptyTable": "No hay información",
                                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                                "infoFiltered": "(filtrado de _MAX_ total Usuarios)",
                                "lengthMenu": "Mostrar _MENU_ Usuarios",
                                "loadingRecords": "Cargando...",
                                "processing": "Procesando...",
                                "search": "Buscador:",
                                "zeroRecords": "Sin resultados encontrados",
                                "paginate": {
                                    "first": "Primero",
                                    "last": "Último",
                                    "next": "Siguiente",
                                    "previous": "Anterior"
                                }
                            },
                            "responsive": true,
                            "lengthChange": true,
                            "autoWidth": false,
                            buttons: [
                                {
                                    extend: 'collection',
                                    text: 'Reportes',
                                    orientation: 'landscape',
                                    buttons: [
                                        { extend: 'copy', text: 'Copiar' },
                                        { extend: 'pdf', text: 'PDF' },
                                        { extend: 'csv', text: 'CSV' },
                                        { extend: 'excel', text: 'Excel' },
                                        { extend: 'print', text: 'Imprimir' }
                                    ]
                                },
                                {
                                    extend: 'colvis',
                                    text: 'Visor de columnas'
                                }
                            ],
                        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
