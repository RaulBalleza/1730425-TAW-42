@extends('layout.app')
<br/>
<br/>
<br/>
<br/>
<br/>

<form action="{{ url('/empleados/'.$empleado->id) }}" method="POST">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
	<div class="form-group">
		<label for="nombre">{{'Nombre'}}</label>
		<input type="text" name="nombre" class="form-control" placeholder="Ingresa el nombre" value="{{ $empleado->nombre }}">
	</div>
	<div class="form-group">
		<label for="apellidos">{{'Apellidos'}}</label>
		<input type="text" name="apellidos" class="form-control" placeholder="Ingresa el apellido" value="{{ $empleado->apellidos }}">
	</div>
	<div class="form-group">
		<label for="cedula">{{'Cedula'}}</label>
		<input type="number" name="cedula" class="form-control" placeholder="Ingresa la cedula" value="{{ $empleado->cedula }}">
	</div>
	<div class="form-group">
		<label for="email">{{'Correo electrónico'}}</label>
		<input type="email" name="email" class="form-control" placeholder="Ingresa el correo electrónico" value="{{ $empleado->email }}">
	</div>
	<div class="form-group">
		<label for="lugar_nacimiento">{{'Lugar de nacimiento'}}</label>
		<input type="text" name="lugar_nacimiento" class="form-control" placeholder="Ingresa el lugar de nacimiento" value="{{ $empleado->lugar_nacimiento }}">
	</div>
	<div class="form-group">
		<select name="sexo">
			<option value="masculino">Masculino</option>
			<option value="femenino">Femenino</option>
			<option value="no especificado">No especificado</option>
		</select>
	</div>
	<div class="form-group">
		<select name="estado_civil">
			<option value="soltero">Soltero</option>
			<option value="casado">Casado</option>
		</select>
	</div>
	<div class="form-group">
		<label for="telefono">{{'Teléfono'}}</label>
		<input type="number" name="telefono" class="form-control" placeholder="Ingresa el lugar de nacimiento" value="{{ $empleado->telefono }}">
	</div>
	<div class="form-group">
		<input type="submit" value="Enviar">
	</div>
</form>