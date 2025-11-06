<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agendamiento de citas Silvia peluqueria</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        /* === PALETA DE COLORES ===
        1. Blanco: #FFFFFF 
        2. Amarillo/Oro: #DD881A
        3. Marrón Chocolate: #7E4F3D
        4. Negro: #000000
        */

        /* === NAVBAR SUPERIOR === */
        .main-header.navbar {
            background-color: #000000 !important;
            border-bottom: 1px solid #DD881A;
        }
        .main-header.navbar .nav-link {
            color: #FFFFFF !important;
        }
        .main-header.navbar .nav-link:hover {
            color: #DD881A !important;
        }

        /* === SIDEBAR === */
        .main-sidebar, .sidebar-dark-primary {
            background-color: #000000 !important;
            border-right: 1px solid #7E4F3D;
        }
        .main-sidebar .brand-link {
            border-bottom: 1px solid #7E4F3D;
            color: #FFFFFF !important;
        }
        .main-sidebar .brand-text {
            color: #DD881A !important;
        }
        .main-sidebar .user-panel {
            border-bottom: 1px solid #7E4F3D;
        }
        .main-sidebar .user-panel a {
            color: #FFFFFF !important;
        }

        /* === MENÚ LATERAL === */
        .nav-sidebar .nav-link {
            color: #FFFFFF !important;
        }
        .nav-sidebar .nav-link:hover,
        .nav-sidebar .nav-link.active,
        .nav-sidebar .menu-open > .nav-link {
            background-color: #DD881A !important;
            color: #000000 !important;
        }

        /* === BOTÓN CERRAR SESIÓN === */
        .nav-item a[style*="background-color: #dc3545;"] {
            background-color: #541212 !important;
            color: #FFFFFF !important;
        }
        .nav-item a[style*="background-color: #dc3545;"]:hover {
            background-color: #841818 !important;
            color: #000000 !important;
        }

        /* === CUERPO Y FOOTER === */
        .content-wrapper {
            background-color: #FFFFFF;
        }
        .main-footer {
            background-color: #000000 !important;
            color: #FFFFFF !important;
            border-top: 1px solid #841818;
        }
        .main-footer a {
            color: #DD881A !important;
        }

        /* === BOTONES === */

        /* Botón azul → dorado */
        .btn-primary, 
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #DD881A !important;
            border-color: #DD881A !important;
            color: #000000 !important;
        }
        .btn-primary:hover {
            background-color: #c47414 !important;
            border-color: #c47414 !important;
            color: #FFFFFF !important;
        }

        /* Botón verde → marrón */
        .btn-success {
            background-color: #7E4F3D !important;
            border-color: #7E4F3D !important;
            color: #FFFFFF !important;
        }
        .btn-success:hover {
            background-color: #633e30 !important;
            border-color: #633e30 !important;
        }

        /* Botón rojo → tono cálido */
        .btn-danger {
            background-color: #841818 !important;
            border-color: #841818 !important;
        }
        .btn-danger:hover {
            background-color: #a11f1f !important;
            border-color: #a11f1f !important;
        }

        /* Paginación activa */
        .page-item.active .page-link {
            background-color: #DD881A !important;
            border-color: #DD881A !important;
            color: #000000 !important;
        }

        /* Botones secundarios */
        .btn-secondary, .buttons-colvis, .buttons-html5 {
            background-color: #7E4F3D !important;
            border-color: #7E4F3D !important;
            color: #FFFFFF !important;
        }
        .btn-secondary:hover, .buttons-colvis:hover, .buttons-html5:hover {
            background-color: #633e30 !important;
            border-color: #633e30 !important;
        }

        /* Iconos en botones */
        .btn i {
            color: #FFFFFF !important;
        }
        .btn-primary i {
            color: #000000 !important;
        }
    </style>

    <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<!-- === NAVBAR === -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url('/admin')}}" class="nav-link">Agendamiento de citas Silvia peluqueria</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" data-widget="fullscreen" href="#" role="button"><i class="fas fa-expand-arrows-alt"></i></a></li>
        <li class="nav-item"><a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a></li>
    </ul>
</nav>

<!-- === SIDEBAR === -->
<aside class="main-sidebar sidebar-dark-primary elevation-4"> 
    <a href="index3.html" class="brand-link">
        <img src="{{url('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIS Citas</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="#" class="nav-link active bg-warning">
                        <i class="nav-icon fas bi bi-people-fill"></i>
                        <p>Usuarios <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="{{url('admin/usuarios/create')}}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>Creación de usuarios</p></a></li>
                        <li class="nav-item"><a href="{{url('admin/usuarios')}}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>Listado de usuarios</p></a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link active bg-warning">
                        <i class="nav-icon fas bi bi-person-circle"></i>
                        <p>Clientes <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="{{url('admin/clientes/create')}}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>Creación de clientes</p></a></li>
                        <li class="nav-item"><a href="{{url('admin/clientes')}}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>Listado de clientes</p></a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link active bg-warning">
                        <i class="bi bi-calendar-event"></i>
                        <p>Horarios <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="{{url('admin/horarios/create')}}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>Creación de horarios</p></a></li>
                        <li class="nav-item"><a href="{{url('admin/horarios')}}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>Listado de horarios</p></a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link active bg-warning">
                        <i class="bi bi-calendar-event"></i>
                        <p>Citas <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="{{url('admin/citas/create')}}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>Creación de citas</p></a></li>
                        <li class="nav-item"><a href="{{url('admin/citas')}}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>Listado de citas</p></a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" style="background-color: #dc3545;"> 
                        <i class="nav-icon fas bi bi-door-closed"></i>
                        <p>Cerrar sesión</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>

@if( (($message = Session::get('mensaje')) && ($icon = Session::get('icono'))) )
<script>
Swal.fire({
    position: "top-end",
    icon: "{{$icon}}",
    title: "{{$message}}",
    showConfirmButton: false,
    timer: 3500
});
</script>
@endif

<!-- === CONTENIDO PRINCIPAL === -->
<div class="content-wrapper"><br>
    <div class="container">@yield('content')</div>
</div>

<!-- === FOOTER === -->
<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">Anything you want</div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

</div>

<script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{url('dist/js/adminlte.min.js')}}"></script>

</body>
</html>
