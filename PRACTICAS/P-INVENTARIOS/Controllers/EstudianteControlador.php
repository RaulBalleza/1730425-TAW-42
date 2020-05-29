<?php
class EstudianteControlador
{
    function __construct()
    {
    }
    // Envia a la vista de mostrar
    function mostrar()
    {
        $id = $_GET['id']; // Obtiene el id extraído de la url a través del método GET
        $estudiantes = Estudiante::obtenerEstudiantes($id);

        require_once('Views/Estudiantes/mostrar.php');
    }
    // Envia a la vista de registro
    function registrar()
    {
        $id = $_GET['id'];
        require_once('Views/Estudiantes/registrar.php');
    }

    // Envía los campos ingresados en el formulario de registro a un método en el modelo para añadirlos a la base de datos
    function guardar()
    {
        $estudiante = new Estudiante($_POST['txtMatricula'], $_POST['txtNombre'], $_POST['txtPromedio'], $_POST['txtEdad'], $_POST['txtCarrera']);

        Estudiante::registrar($estudiante);
    }

    // Envia a la vista de actualizar
    function actualizarEstudiante()
    {
        $id = $_GET['id']; // Obtiene el id extraído de la url a través del método GET

        $estudiante = Estudiante::obtenerEstudiante($id); // Crea una instancia de la clase del modelo e invoca un método que recupera los atributos de la instancia llamada con un id

        // Llama a la vista actualizar con los datos previamente recuperados de la instancia en cuestión
        require_once('Views/Estudiantes/actualizar.php');
    }

    // Actualiza los campos ingresados en el formulario a un método en el modelo para modificarlos en la base de datos
    function actualizar()
    {
        $estudiante = new Estudiante($_POST['txtMatricula'], $_POST['txtNombre'], $_POST['txtPromedio'], $_POST['txtEdad'], $_POST['txtCarrera']);

        Estudiante::actualizar($estudiante);
        $this->mostrar();
    }

    // Método para llamar al método eliminar dentro del modelo
    function eliminar()
    {
        $id = $_GET['id']; // Obtiene el id extraído de la url a través del método GET

        Estudiante::eliminar($id);
        $this->mostrar();
    }
}
