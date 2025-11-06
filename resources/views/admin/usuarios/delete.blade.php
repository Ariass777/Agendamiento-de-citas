@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>Usuario: {{$usuario->name}}</h1>
</div>

<hr>
<div class="row">
    <div class="col-md-10">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">¿Seguro que desea eliminar este registro?</h3>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{url('/admin/usuarios',$usuario->id)}}" method="POST">
                  @csrf
                    @method('DELETE')
                                  <div class="row">
                  <div class="col-md-12">
                    <div class="form group">
                      <label for="">Nombre</label> 
                      <input type="text" value="{{$usuario->name}}" name="name" class="form-control" disabled>
                      @error('name')
                      <small style="color:red">{{$message}}</small>
                       @enderror
                    </div>
                  </div>
                </div> 
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form group">
                      <label for="">Confirmar Contraseña</label>
                      <input type="password" value="{{old('password_confirmation')}}" name="password_confirmation" class="form-control" disabled>
                      @error('password_confirmation')
                      <small style="color:red">{{$message}}</small>
                       @enderror
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form group">
                      <a href="{{url('admin/usuarios')}}" class="btn btn-secondary">Cancelar</a>
                      <button type="submit" class="btn btn-danger">Eliminar usuario</button>
                    </div>
                  </div>
                </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
</div>
@endsection