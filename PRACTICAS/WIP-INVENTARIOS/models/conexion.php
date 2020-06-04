<?php
/*Clase para establecer la conexion a la bd mediante PDO*/
/**
 * 
 */
class Conexion{
	//metodo/funcion que sirve para conectarse a la base de datos y realizar las consultas necesarias
	public function conectar(){
		$enlace = new PDO("mysql:host=localhost;dbname=simple_stock", "root", "root");
		return $enlace;
	}
}

?>