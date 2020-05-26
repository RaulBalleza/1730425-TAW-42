<?php

class CategoriasProductoControlador{
    
  function __construct(){
  }
  
  // Envia a la vista de registro
  function registrar(){
    require_once('Views/CategoriasProducto/registrar.php');
  }

  // Envía los campos ingresados en el formulario de registro a un método en el modelo para añadirlos a la base de datos
  function guardar(){
    $categoria_producto= new CategoriasProducto(null, $_POST['txtNombre']);

    CategoriasProducto::registrar($categoria_producto);
  }

  // Envia a la vista de mostrar
  function mostrar(){
    $categorias = CategoriasProducto::obtenerCategorias();

    require_once('Views/CategoriasProducto/mostrar.php');
  }

  // Envia a la vista de actualizar
  function actualizarCategoria(){
    $id = $_GET['id']; // Obtiene el id extraído de la url a través del método GET

    $categoria = CategoriasProducto::obtenerCategoria($id); // Crea una instancia de la clase del modelo e invoca un método que recupera los atributos de la instancia llamada con un id
    
    // Llama a la vista actualizar con los datos previamente recuperados de la instancia en cuestión
    require_once('Views/CategoriasProducto/actualizar.php');
  }
  
  // Actualiza los campos ingresados en el formulario a un método en el modelo para modificarlos en la base de datos
  function actualizar(){
		$categoria = new CategoriasProducto( $_POST["txtId"], $_POST['txtNombre'] );
    
    CategoriasProducto::actualizar($categoria);
		$this->mostrar();
  }
  
  // Método para llamar al método eliminar dentro del modelo
  function eliminar(){
		$id=$_GET['id']; // Obtiene el id extraído de la url a través del método GET
    
    CategoriasProducto::eliminar($id);
		$this->mostrar();
	}
}

?>