<?php
class EstudianteControlador
{
    function __construct()
    {
    }
    // Envia a la vista de mostrar
    function mostrar()
    {
        require_once('Views/Estudiantes/mostrar.php');
    }
}
