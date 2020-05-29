<?php
/* 
	Fichero para declarar controladores y las acciones para cada uno de estos.
	Asímismo se encarga de enviar al controlador adecuado junto con la acción que se carga desde el Index
*/

// Se inicializa un arreglo para los controladores que disponemos
$controllers=array(
	// 'Alumno'=>['index','register','save','show','updateshow','update','delete','search','error'],
	'Usuario'=>['login','iniciar','logout'],
	'Producto'=>['mostrar','registrar','guardar','actualizarProducto','actualizar','eliminar'],
	'CategoriasProducto'=>['mostrar','registrar','guardar','actualizarCategoria','actualizar','eliminar'],
	'Fabricante'=>['mostrar','registrar','guardar','actualizarFabricante','actualizar','eliminar'],
	'CategoriasFabricante'=>['mostrar','registrar','guardar','actualizarCategoria','actualizar','eliminar'],
);

if ( array_key_exists($controller,  $controllers) ) {
	
	if ( in_array($action, $controllers[$controller]) ) {
		call($controller, $action);
	}
	else{
		require_once('Views/error.php');
	}
}
else{
	require_once('Views/bienvenido.php');
}

function call($controller, $action){
	
	require_once('Controllers/'.$controller.'Controlador.php');

	switch ($controller) {
		case 'Usuario':
			require_once('Model/Usuario.php');
			$controller= new UsuarioControlador();
		break;
		case 'Producto':
			require_once('Model/Producto.php');
			$controller= new ProductoControlador();
		break;
		case 'Fabricante':
			require_once('Model/Fabricante.php');
			$controller= new FabricanteControlador();
		break;
		case 'CategoriasProducto':
			require_once('Model/CategoriasProducto.php');
			$controller= new CategoriasProductoControlador();
		break;
		case 'CategoriasFabricante':
			require_once('Model/CategoriasFabricante.php');
			$controller= new CategoriasFabricanteControlador();
		break;
		case  'Estudiante':
			require_once('Model/Estudiante.php');
			$controller= new EstudianteControlador();
		break;
		case  'Universidad':
			require_once('Model/Universidad.php');
			$controller= new UniversidadControlador();
		break;
		case  'Carrera':
			require_once('Model/Carrera.php');
			$controller= new CarreraControlador();
		break;
		default:
			// Code ... 
		break;
	}

	$controller->{$action}();
}
