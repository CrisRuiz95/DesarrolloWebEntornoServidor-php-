<?php
// Inicia sesión y controla acceso
include_once "../../includes/comprobarSesion.php";

// Carga el modelo del profesor
include_once __DIR__ . "/../model/profesorModel.php";

// Si el profesor envía un mensaje_profesor sobre una tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_tarea'], $_POST['mensaje_profesor'])) {
    $id = intval($_POST['id_tarea']);
    $mensaje_profesor = trim($_POST['mensaje_profesor']);

    // Guardar mensaje_profesor en la base de datos
    $sql = "UPDATE tareas SET mensaje_profesor = '$mensaje_profesor' WHERE id_tarea = $id";
    eduflow::consultaInsercion($sql);

    // Mensaje de confirmación
    $_SESSION['mensaje'] = "comentario guardado correctamente.";
    header("Location: profesorController.php");
    
    exit;
}

// Carga la vista del profesor
include_once __DIR__ . "/../view/profesorView.php";