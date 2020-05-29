<?php
class UniversidadControlador
{
    function __construct()
    {
    }
    // Envia a la vista de mostrar
    function mostrar()
    {
        $universidades = Universidad::obtenerUniversidades();

        require_once('Views/Universidades/mostrar.php');
    }
    // Envia a la vista de registro
    function registrar()
    {
        require_once('Views/Universidades/registrar.php');
    }

    // Envía los campos ingresados en el formulario de registro a un método en el modelo para añadirlos a la base de datos
    function guardar()
    {
        $universidad = new Universidad(null, $_POST['txtNombre']);

        Universidad::registrar($universidad);
    }

    // Envia a la vista de actualizar
    function actualizarUniversidad()
    {
        $id = $_GET['id']; // Obtiene el id extraído de la url a través del método GET

        $universidad = Universidad::obtenerUniversidad($id); // Crea una instancia de la clase del modelo e invoca un método que recupera los atributos de la instancia llamada con un id

        // Llama a la vista actualizar con los datos previamente recuperados de la instancia en cuestión
        require_once('Views/Universidades/actualizar.php');
    }

    // Actualiza los campos ingresados en el formulario a un método en el modelo para modificarlos en la base de datos
    function actualizar()
    {
        $universidad = new Universidad($_POST["txtId"], $_POST['txtNombre']);

        Universidad::actualizar($universidad);
        $this->mostrar();
    }

    // Método para llamar al método eliminar dentro del modelo
    function eliminar()
    {
        $id = $_GET['id']; // Obtiene el id extraído de la url a través del método GET

        Universidad::eliminar($id);
        $this->mostrar();
    }
}
