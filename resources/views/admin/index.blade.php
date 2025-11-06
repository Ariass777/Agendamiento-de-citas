@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>Panel principal</h1>
</div>

<hr>

<div class="row">
    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$total_usuarios}}</h3>

                <p>Usuarios</p>
              </div>
              <div class="icon">
                <i class="ion fas bi bi-file-person"></i>
              </div>
              <a href="{{url('admin/usuarios')}}" class="small-box-footer">Más informacion <i class="bi bi-file-earmark-person"></i></a>
            </div>
          </div>
</div>
@endsection