<?php
//Para comprobar la sesión para cerrarla correctamente o iniciarla
include '../../includes/comprobarSesion.php';
include '../model/estudiantesModel.php';


// Solo estudiantes pueden acceder
if ($_SESSION['usuario']['perfil'] !== 'estudiante') {
    header("Location: index.php");
    exit;
}

$mensaje = "";

// Si el estudiante entrega una tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tarea_titulo'])) {

    $nombre_tarea   = $_POST['tarea_titulo'];
    $asignatura     = $_POST['asignatura'];
    $nombre_profesor = $_POST['profesor'];
    $nombre_alumno  = $_SESSION['usuario']['nombre_completo'];

    // Guardar entrega en BD
    $guardado = guardar_entrega($nombre_tarea, $asignatura, $nombre_profesor, nombre_alumno: $nombre_alumno);

    if ($guardado) {
        $mensaje = "La tarea '{$nombre_tarea}' se ha entregado correctamente.";
    } else {
        $mensaje = "Error al registrar la entrega. Inténtalo de nuevo.";
    }
}

// Cargar materias y tareas del XML
[$materias, $tareas] = obtener_materias_y_tareas();

//Cargar vista
include __DIR__ . '/../view/estudiantesView.php';
