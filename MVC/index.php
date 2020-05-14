<?php

//Invocación a los métodos
require_once 'models/enlaces.php';
require_once 'models/crud.php';
require_once 'models/crudProduct.php';

//CONTROLADOR
//Creación de los objetos, la lógica del negocio
require_once 'controllers/controller.php';

//muestra la función o método "página"
$mvc->showPage();
?>