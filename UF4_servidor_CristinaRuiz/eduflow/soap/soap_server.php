<?php
require_once "../modelo/bd/mysql.php";

class ProfesorSOAP {

    public function listarTareas() {
        $sql = "SELECT * FROM tareas_profesor ORDER BY id ASC";
        return eduflow::consultaLectura($sql);
    }

    public function crearTarea($titulo, $descripcion, $fecha, $asignatura, $urgente) {

        $archivo = "portada1.png";


        $sql = "
            INSERT INTO tareas_profesor (titulo, descripcion, fecha_entrega, asignatura, urgente, archivo)
            VALUES ('$titulo', '$descripcion', '$fecha', '$asignatura', '$urgente', '$archivo')
        ";

        if (eduflow::consultaInsercion($sql)) {
            return "Tarea creada correctamente";
        }
        return "Error al crear la tarea";
    }

    public function eliminarTarea($asignatura) {
        $sql = "DELETE FROM tareas_profesor WHERE asignatura = '$asignatura'";
        if (eduflow::consultaInsercion($sql)) {
            return "Tareas eliminadas correctamente";
        }
        return "Error al eliminar tareas";
    }
}

$options = [
    "uri" => "http://localhost/eduflow/soap/"
];

$server = new SoapServer(null, $options);
$server->setClass("ProfesorSOAP");
$server->handle();
