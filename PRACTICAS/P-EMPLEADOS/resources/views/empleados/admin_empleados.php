<!--@extends('layout.app')

@section('titulo', 'Empleados')

<br/>
<br/>
<br/>

<a class="btn btn-primary" href="{{ url('empleados/create') }}">Agregar empleado</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Cedula</th>
      <th scope="col">Email</th>
      <th scope="col">Lugar de nacimiento</th>
      <th scope="col">Sexo</th>
      <th scope="col">Estado civil</th>
      <th scope="col">Telefono</th>
      <th scope="col">Editar</th>
      <th scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody>
    @foreach($empleados as $empleado)
    <tr>
      <td>{{ $empleado->nombre }}</td>
      <td>{{ $empleado->apellidos }}</td>
      <td>{{ $empleado->cedula }}</td>
      <td>{{ $empleado->email }}</td>
      <td>{{ $empleado->lugar_nacimiento }}</td>
      <td>{{ $empleado->sexo }}</td>
      <td>{{ $empleado->estado_civil }}</td>
      <td>{{ $empleado->telefono }}</td>
      <td>
        <a class="btn btn-warning" href="{{ url('/empleados/'.$empleado->id.'/edit') }}">Editar</a>
      </td>
      <td>
        <form method="POST" action="{{ url('/empleados/'. $empleado->id) }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button type="submit" onclick="return confirm('¿Eliminar?');" class="btn btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>

</table>-->


@extends ('layout.patron');
@section ('titulo','Administración de empleados');
@section ('contenido');
<!-- Código HTML puro para mostrar el listado de empleados -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Administración de empleados</h3>
            </div>
        </div>
    </div>

    <div class="clearfix">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Listado de empleados</h2>
                    <div class="clearfix">

                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-keytable" class="table table-striped table-bordered" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Nombre(s)</th>
                                                <th>Apellido(s)</th>
                                                <th>Cédula</th>
                                                <th>Email</th>
                                                <th>Lugar de nacimiento</th>
                                                <th>Sexo</th>
                                                <th>Estado civil</th>
                                                <th>Teléfono</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($empleados as $empleado)
                                          <tr>
                                            _create_empleados_table
                                            <td>{{$empleado->nombre}}</td>
                                            <td>{{$empleado->apellidos}}</td>
                                            <td>{{$empleado->cedula}}</td>
                                            <td>{{$empleado->email}}</td>
                                            <td>{{$empleado->lugar_nacimiento}}</td>
                                            <td>{{$empleado->sexo}}</td>
                                            <td>{{$empleado->estado_civil}}</td>
                                            <td>{{$empleado->telefono}}</td>
                                            <td>
                                              <div style="display: flex;">
                                                <a href="{{ url('empleados/'.$empleado->id.'/edit') }}" class="btn btn-secondary"><i class="fas fa-edit"></i></a>
                                                <form action="{{ url('empleados/'.$empleado-id) }}" method="POST">
                                                  {{ csrf_field() }}
                                                  {{ method_field('DELETE') }}
                                                  <button class="btn btn-danget"><i class="fas fa-trash"></i></button>
                                                </form>
                                              </div>
                                            </td>
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
        </div>
    </div>
</div>
