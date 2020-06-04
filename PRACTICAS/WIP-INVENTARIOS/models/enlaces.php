<?php
	/**
	 * 
	 */
	class EnlacesPaginas{
		/*Metodo/funcion para seleccionar la vista correcta dependiendo de la opcion que haya elegido el usuario*/
		public function enlacesPaginasModel($enlacesModel){
			# code...
			if ($enlacesModel =="ingresar"|| $enlacesModel =="usuarios" || $enlacesModel =="inventario"|| $enlacesModel=="categorias"|| $enlacesModel =="tablero"|| $enlacesModel =="ventas"|| $enlacesModel=="salir"){
					$module = "views/modules/".$enlacesModel.".php";
				}
				 else if($enlacesModel=="index"){
					$module="views/modules/tablero.php";
				} else{
					$module="views/modules/tablero.php";
				}	
				return $module;	
		}
	}
?>