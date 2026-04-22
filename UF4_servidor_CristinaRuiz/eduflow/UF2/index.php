<?php
//conectamos los criterios de login desde el controller
include "controller/loginController.php"; 
// conectar la cabecera con nuestro index
include "view/cabecera.php";

// si no se conecta con el usuario vacio nos redirige al Form
if (empty($_SESSION['user'])) {
  include "view/loginForm.php";
  exit;
}

// Redirigimos la sesión dependiendo del registro de sesión (admin, estudiante o profesor)
switch ($_SESSION['role']) {
  case 'administrador':
    include "view/adminView.php";
    break;
  case 'estudiante':
    include "controller/estudiantesController.php";
    break;
  case 'profesor':
    include "controller/profesorController.php";
    break;
  default:
    include "view/loginForm.php";
    break;
}
