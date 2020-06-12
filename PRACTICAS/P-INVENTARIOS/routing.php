<?php
/* 
	Fichero para declarar controladores y las acciones para cada uno de estos.
	Asímismo se encarga de enviar al controlador adecuado junto con la acción que se carga desde el Index
*/

// Se inicializa un arreglo para los controladores que disponemos
$controllers=array(
	// 'Alumno'=>['index','register','save','show','updateshow','update','delete','search','error'],
	'Usuario'=>['mostrar','registrar','guardar','actualizarUsuario','actualizar','eliminar','login','iniciar','logout'],
	'Producto'=>['mostrar','registrar','guardar','actualizarProducto','actualizar','eliminar'],
	'CategoriasProducto'=>['mostrar','registrar','guardar','actualizarCategoria','actualizar','eliminar']
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
		case 'CategoriasProducto':
			require_once('Model/CategoriasProducto.php');
			$controller= new CategoriasProductoControlador();
		break;
		default:
			// Code ... 
		break;
	}

	$controller->{$action}();
}
