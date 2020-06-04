<?php
class UsuarioControlador
{

  function __construct()
  {
  }

  // Envia a la vista de iniciar sesión
  function login()
  {
    require_once('Views/Usuarios/login.php');
  }

  // Envia a la vista de bienvenida
  function bienvenido()
  {
    require_once('Views/Usuarios/bienvenido.php');
  }

  // Envía los campos ingresados en el formulario de login a un método en el modelo para verificar
  function iniciar()
  {

    // Arreglo asociativo para enviar al modelo los campos ingresados
    $usuario = array(
      "usuario" => $_POST['txtUsuario'],
      "password" => $_POST['txtPassword']
    );

    if (Usuario::login($usuario)) {

      session_start();

      // Obtenemos los datos del registro en la tabla Usuarios a través de una consulta al modelo
      $datos = Usuario::obtener($usuario);
      // Posteriormente los guardamos en una variable de sesión
      $_SESSION["usuario"] = array(
        "id" => $datos["id"],
        "usuario" => $datos["usuario"],
        "email" => $datos["email"],
        "privilegio" => $datos["privilegio"]
      );

      header("location:index.php");
    } else {
      echo "<div class='alert alert-danger'><strong>Lo sentimos. El nombre de usuario o la contraseña son inválidos :( <a href='?controller=Usuario&action=login'>Por favor inténtelo nuevamente</a></strong>.</div>";
    }
  }

  function logout()
  {
    session_start();
    session_unset();
    session_destroy();
    header("location:index.php");
  }
}
