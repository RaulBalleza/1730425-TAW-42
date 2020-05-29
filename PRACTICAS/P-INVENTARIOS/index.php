<?php
	// Se importa el script para la conexión a la base de datos
	require_once('connection.php');

	// Carga el controlador y la acción y se evalúan 
	if( isset($_GET['controller']) && isset($_GET['action']) ) {
		
		$controller=$_GET['controller'];
		$action=$_GET['action'];
	}
	else {
		$controller = "";
	}

	// Lo segundo que se carga, después de la conexión, es el fichero layout.php contenido en el directorio de las vistas
	// Este fichero es el primero que se visualiza al acceder al Index
	require_once('Views/Layouts/layout.php');
	// require_once('Views/bienvenido.php');
 ?>