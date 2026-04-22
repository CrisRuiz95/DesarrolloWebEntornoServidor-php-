<?php
session_start();

// LOGIN (nos ponemos en contacto con el modelo)
include "model/loginModel.php"; 

//Usamos el método POST para identificar el usuario y la contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'], $_POST['clave'])) {
  $usuario = ($_POST['usuario']);
  $clave   = ($_POST['clave']);

  //Si el usuario y la clave están vacios devuelve un mensaje
  if ($usuario === '' || $clave === '') {
    $_SESSION['error'] = "Rellena usuario y contraseña.";
    header("Location: index.php");
    exit;
  }

  //Validamos el ususario y la clave para iunciar sesion y añadir la fecha o la hora de cuando se inicia cuando el role es verdadero
  $role = validar_usuario($usuario, $clave); 
  if ($role !== false) {
    session_regenerate_id(true);
    $_SESSION['user'] = $usuario;
    $_SESSION['role'] = $role;
    $_SESSION['last_activity'] = time();     
    $_SESSION['login_time'] = date('H:i');
    header("Location: index.php");
    exit;
  }
//En caso contrario, cuando existe un error sale el siguiente mensaje
  $_SESSION['error'] = "Usuario o contraseña incorrectos.";
  header("Location: index.php");
  exit;
}

// Tiempo de conexión 30 minutos (tiempo límite) si se pasa ese limite sale mensaje
$TL = 60 * 30;
if (!empty($_SESSION['user'])) {
  if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $TL) {
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['error'] = "Sesión caducada por inactividad (30 min).";
    header("Location: index.php");
    exit;
  }
  $_SESSION['last_activity'] = time();
}
?>