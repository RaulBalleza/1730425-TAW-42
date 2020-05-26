<?php

class CategoriasFabricanteControlador{
    
  function __construct(){
  }
  
  // Envia a la vista de registro
  function registrar(){
    require_once('Views/CategoriasFabricante/registrar.php');
  }

  // Envía los campos ingresados en el formulario de registro a un método en el modelo para añadirlos a la base de datos
  function guardar(){
    $categoria_fabricante = new CategoriasFabricante(null, $_POST['txtNombre']);

    CategoriasFabricante::registrar($categoria_fabricante);
  }

  // Envia a la vista de mostrar
  function mostrar(){
    $categorias = CategoriasFabricante::obtenerCategorias();

    require_once('Views/CategoriasFabricante/mostrar.php');
  }

  // Envia a la vista de actualizar
  function actualizarCategoria(){
    $id = $_GET['id']; // Obtiene el id extraído de la url a través del método GET

    $categoria = CategoriasFabricante::obtenerCategoria($id); // Crea una instancia de la clase del modelo e invoca un método que recupera los atributos de la instancia llamada con un id
    
    // Llama a la vista actualizar con los datos previamente recuperados de la instancia en cuestión
    require_once('Views/CategoriasFabricante/actualizar.php');
    
  }
  
  // Actualiza los campos ingresados en el formulario a un método en el modelo para modificarlos en la base de datos
  function actualizar(){
		$categoria = new CategoriasFabricante( $_POST["txtId"], $_POST['txtNombre'] );
    
    CategoriasFabricante::actualizar($categoria);
		$this->mostrar();
  }

  // Método para llamar al método eliminar dentro del modelo
  function eliminar(){
    $id=$_GET['id']; // Obtiene el id extraído de la url a través del método GET
    
    CategoriasFabricante::eliminar($id);
    $this->mostrar();
  }
    
}

?>