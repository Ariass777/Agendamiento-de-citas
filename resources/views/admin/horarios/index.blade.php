@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>Listado de horarios</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Horarios registrados</h3>

                <div class="card-tools">
                <a href="{{url('admin/horarios/create')}}" class="btn btn-primary">
                    Registrar nuevo
</a>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                        <table id="example1" class="table table-striped table-bordered table-hover table-sm">
<thead style="background-color: #c0c0c0;">
    <tr>
    <td style="..."><b>#</b></td>
    <td style="..."><b>Estilista</b></td>
    <td style="..."><b>Dia de atencion</b></td>
    <td style="..."><b>Hora inicio</b></td>
        <td style="text-align: center"><b>Hora final</b></td>
        <td style="..."><b>Acciones</b></td>
    </tr>
</thead>
<tbody>
    <?php $contador=1; ?>
    @foreach($horarios as $horario)
            <tr>
                <td style="...">{{$contador++}}</td>
                <td>{{$horario->usuario->name}}</td>
                <td>{{$horario->dia}}</td>
                <td>{{$horario->hora_inicio}}</td>
                <td>{{$horario->hora_fin}}</td>
                <td style="text-align: center">
                    <div class="btn-group" role="group" aria-label="Basic example">
  <a href="{{url('admin/horarios/'.$horario->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
  <a href="{{url('admin/horarios/'.$horario->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
  <a href="{{url('admin/horarios/'.$horario->id.'/confirm-delete')}}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
</div>
                </td>
            </tr>
                @endforeach
  </tbody>
</table>
<script>
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Horarios",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Horarios",
                                    "infoFiltered": "(Filtrado de _MAX_ total Horarios)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Horarios",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                "responsive": true, "lengthChange": true, "autoWidth": false,
                                buttons: [{
                                    extend: 'collection',
                                    text: 'Reportes',
                                    orientation: 'landscape',
                                    buttons: [{
                                        text: 'Copiar',
                                        extend: 'copy',
                                    }, {
                                        extend: 'pdf'
                                    },{
                                        extend: 'csv'
                                    },{
                                        extend: 'excel'
                                    },{
                                        text: 'Imprimir',
                                        extend: 'print'
                                    }
                                    ]
                                },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                        collectionLayout: 'fixed three-column'
                                    }
                                ],
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                    </script>
            </div>
            </div>
        </div>       
    </div>
    <br>
    <div class="row">
        <div class="col-md-12"> <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Calendario de atencion de estilistas</h3>
                </div>
                <div class="card-body">
                    <table style="font-size: 15px;text-align: center" class="table table-striped table-hover table-sm table-bordered">
                        <thead>
                            <tr style="text-align: center">
                                <th>Hora</th>
                                <th>Lunes</th>
                                <th>Martes</th>
                                <th>Miércoles</th>
                                <th>Jueves</th>
                                <th>Viernes</th>
                                <th>Sábado</th>
                                <th>Domingo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $horas = ['08:00 - 09:00', '09:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00', '12:00 - 13:00', '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00', '16:00 - 17:00', '17:00 - 18:00', '18:00 - 19:00', '19:00 - 20:00', '20:00 - 21:00'];
                            $diasSemana = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO'];
                            @endphp
                            @foreach($horas as $hora)
                            @php
                            list($hora_inicio, $hora_fin) = explode(' - ', $hora);
                            @endphp
                            <tr>
                                <td>{{$hora}}</td>
                                @foreach($diasSemana as $dia)
                                @php
                                $nombres = [];
                                foreach($horarios as $horario){
                                if(strtoupper($horario->dia) == $dia &&
                                $hora_inicio >= $horario->hora_inicio &&
                                $hora_fin <= $horario->hora_fin){
                                $nombres[] = $horario->usuario->name;
                            }
                        }
                        $nombre = implode('<br>', $nombres);

                                @endphp
                                <td style="white-space: normal;">{!! $nombre !!}</td>

                                @endforeach
                            </tr> 
                            @endforeach  
                        </tbody>
                    </table>
                </div>
            </div>

            </div>
            </div>            
        </div>
    </div>
@endsection