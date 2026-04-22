<?php
require_once "../modelo/bd/mysql.php";  

class ProfesorService {

    // 1️. Listar tareas
    public function listarTareas() {
        $sql = "SELECT id_tarea, nombre_tarea, asignatura, descripcion, fecha_entrega, urgente 
                FROM tareas ORDER BY id_tarea DESC";

        return eduflow::consultaLectura($sql);
    }

    // 2️. Crear tarea
    public function crearTarea($titulo, $descripcion, $fecha_entrega, $asignatura, $urgente) {

        // Siempre portada_1.png
        $archivo = "portada_1.png";

        $sql = "
            INSERT INTO tareas (nombre_tarea, descripcion, fecha_entrega, asignatura, urgente, archivo)
            VALUES ('$titulo', '$descripcion', '$fecha_entrega', '$asignatura', '$urgente', '$archivo')
        ";

        if (eduflow::consultaInsercion($sql)) {
            return "Tarea creada correctamente";
        }
        return "Error al crear la tarea";
    }

    // 3️. Eliminar tarea por asignatura
    public function eliminarTarea($asignatura) {
        $sql = "DELETE FROM tareas WHERE asignatura = '$asignatura'";

        if (eduflow::consultaInsercion($sql)) {
            return "Tarea(s) eliminada(s) correctamente";
        }
        return "Error al eliminar";
    }
}

$options = [
    "uri" => "http://localhost/eduflow/soap/soap_server.php"
];

$server = new SoapServer(null, $options);
$server->setClass("ProfesorService");
$server->handle();
?>
