<?php
class CarreraControlador
{
    function __construct()
    {
    }
    // Envia a la vista de mostrar
    function mostrar()
    {
        $id = $_GET['id'];
        $carreras = Carrera::obtenerCarreras($id);

        require_once('Views/Carreras/mostrar.php');
    }
    // Envia a la vista de registro
    function registrar()
    {
        $id = $_GET['id'];
        require_once('Views/Carreras/registrar.php');
    }

    // Envía los campos ingresados en el formulario de registro a un método en el modelo para añadirlos a la base de datos
    function guardar()
    {
        $carrera = new Carrera(null, $_POST['txtNombre'], $_POST['txtUni']);

        Carrera::registrar($carrera);
    }

    // Envia a la vista de actualizar
    function actualizarCarrera()
    {
        $id = $_GET['id']; // Obtiene el id extraído de la url a través del método GET

        $carrera = Carrera::obtenerCarrera($id); // Crea una instancia de la clase del modelo e invoca un método que recupera los atributos de la instancia llamada con un id

        // Llama a la vista actualizar con los datos previamente recuperados de la instancia en cuestión
        require_once('Views/Carreras/actualizar.php');
    }

    // Actualiza los campos ingresados en el formulario a un método en el modelo para modificarlos en la base de datos
    function actualizar()
    {
        $carrera = new Carrera($_POST["txtId"], $_POST['txtNombre'], $_POST['txtUni']);

        Carrera::actualizar($carrera);
        $this->mostrar();
    }

    // Método para llamar al método eliminar dentro del modelo
    function eliminar()
    {
        $id = $_GET['id']; // Obtiene el id extraído de la url a través del método GET

        Carrera::eliminar($id);
        $this->mostrar();
    }
}
