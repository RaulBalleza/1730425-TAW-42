<?php

class FabricanteControlador{
    
    function __construct(){
    }

    // Dirige hacia la vista con el formulario de registro
    function registrar(){
        require_once('Views/Fabricantes/registrar.php');
    }

    // Envía los campos ingresados en el formulario de registro a un método en el modelo para añadirlos a la base de datos
    function guardar(){
        $fabricante= new Fabricante(null, $_POST['txtNombre'], $_POST['txtDireccion'], $_POST['txtEmail'], $_POST['txtTelefono'], $_POST['txtCategoria'] );

        Fabricante::registrar($fabricante);
    }
    
    // Envia a la vista de mostrar
    function mostrar(){
        $fabricantes = Fabricante::obtenerFabricantes();

        require_once('Views/Fabricantes/mostrar.php');
    }

    // Envia a la vista de actualizar
    function actualizarFabricante(){
        $id = $_GET['id']; // Obtiene el id extraído de la url a través del método GET
        $fabricante = Fabricante::obtenerFabricante($id); // Crea una instancia de la clase del modelo e invoca un método que recupera los atributos de la instancia llamada con un id

        // Llama a la vista actualizar con los datos previamente recuperados de la instancia en cuestión
        require_once('Views/Fabricantes/actualizar.php');
    }

    // Actualiza los campos ingresados en el formulario a un método en el modelo para modificarlos en la base de datos
    function actualizar(){
        $fabricante = new Fabricante( $_POST["txtId"], $_POST['txtNombre'], $_POST['txtDireccion'], $_POST['txtEmail'], $_POST['txtTelefono'], $_POST['txtCategoria'] );

        Fabricante::actualizar($fabricante);
        $this->mostrar();
    }

    // Método para llamar al método eliminar dentro del modelo
    function eliminar(){
        $id=$_GET['id']; // Obtiene el id extraído de la url a través del método GET

        Fabricante::eliminar($id);
        $this->mostrar();
    }
}

?>