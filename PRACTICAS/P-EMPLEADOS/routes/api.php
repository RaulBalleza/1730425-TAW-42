<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Empleado;

Route::get('empleados', function(){
	$empleados = Empleado::get();
	return $empleados;
});

Route::post('empleados', function(Request $request){
	//Verificamos que los datos enviados se reciban bien en la base de datos, para esto se utiliza request

	//Retornar todos los valores del array
	//return $request->all();

	//Retornar solo un parametro

	//return $request->input('estado_civil');

	//Validar datos de empleados
	$request->validate([
		'nombre' => 'required|max:50',
		'apellidos' => 'required|max:50',
		'cedula'=> 'required|max:50',
		'email' => 'required|max:50|email|unique:empleados',
		'lugar_nacimiento' => 'required|max:50',
		'estado_civil' => 'required|max:50',
		'telefono'=> 'required|numeric'
	]);

	//Llenar los parametros usando Request y guardarlo en la tabla de la bd
	$empleado = new Empleado();
	$empleado->nombre = $request->input('nombre');
	$empleado->apellidos = $request->input('apellidos');
	$empleado->cedula = $request->input('cedula');
	$empleado->email = $request->input('email');
	$empleado->lugar_nacimiento = $request->input('lugar_nacimiento');
	$empleado->sexo = $request->input('sexo');
	$empleado->estado_civil = $request->input('estado_civil');
	$empleado->telefono = $request->input('telefono');
	$empleado->save();

	return "Empleado creado";

});

//Ruta para actualizar empleados

Route::put('empleados/{id}', function(Request $request, $id){
	$request->validate([
		'nombre'=>'required|max:50',
		'apellidos'=>'required|max:50',
		'cedula'=>'required|max:20',
		'email'=>'required|max:50|unique:empleados,email,' . $id ,
		'lugar_nacimiento'=>'required|max:50',
		'sexo'=>'required|max:50',
		'estado_civil'=>'required|max:50',
		'telefono'=>'required|numeric'
	]);

	$empleado = Empleado::findOrFail($id);
	$empleado->nombre = $request->input('nombre');
	$empleado->apellidos = $request->input('apellidos');
	$empleado->cedula = $request->input('cedula');
	$empleado->email = $request->input('email');
	$empleado->lugar_nacimiento = $request->input('lugar_nacimiento');
	$empleado->sexo = $request->input('sexo');
	$empleado->estado_civil = $request->input('estado_civil');
	$empleado->telefono = $request->input('telefono');
	//return $empleado;
	$empleado->save();

	return "Empleado actualizado";
});

//Ruta para eliminar empleados

Route::delete('empleados/{id}', function($id){
	$empleado = Empleado::findOrFail($id);
	$empleado->delete();
	return "Empleado eliminado";
});