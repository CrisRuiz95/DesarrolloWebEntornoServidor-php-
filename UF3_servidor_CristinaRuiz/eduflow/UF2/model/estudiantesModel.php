<?php
// Función para cargar los datos desde el XML
function cargar_datos_xml() {
    // Ruta absoluta al archivo XML
    $ruta = __DIR__ . '/../assets/eduFlow.xml';

    if (!file_exists($ruta)) {
        die("No se encontró el archivo XML en: " . htmlspecialchars($ruta));
    }

    $xml = simplexml_load_file($ruta);
    if ($xml === false) {
        die("Error al leer el archivo XML.");
    }

    return $xml;
}

// Función para obtener las materias y las tareas desde el XML
function obtener_materias_y_tareas(): array {
    $xml = cargar_datos_xml();
    $materias = [];
    $tareas = [];

    if ($xml) {
        // Materias
        if (isset($xml->clases->clase)) {
            foreach ($xml->clases->clase as $c) {
                $materias[] = [
                    'nombre'   => (string)$c->asignatura,
                    'profesor' => (string)$c->profesor,
                    'aula'     => (string)$c->aula,
                    'dia'      => (string)$c->dia,
                    'hora'     => (string)$c->hora,
                ];
            }
        }

        // Tareas
        if (isset($xml->tareas->tarea)) {
            foreach ($xml->tareas->tarea as $t) {
                $tareas[] = [
                    'materia'       => (string)$t->asignatura,
                    'titulo'        => (string)$t->titulo,
                    'descripcion'   => (string)$t->descripcion,
                    'fecha_entrega' => (string)$t->fecha_entrega,
                    'urgente'       => strtolower((string)$t->urgente) === 'si',
                    'profesor'      => (string)$t->profesor,
                    'recurso'       => (string)$t->imagen,
                ];
            }
        }
    }

    return [$materias, $tareas];
}

//Función para guardar las entregas de los estudiantes en la base de datos
function guardar_entrega($nombre_tarea, $asignatura, $nombre_profesor, $nombre_alumno) {
  require_once __DIR__ . '/../../modelo/bd/mysql.php';
    // Guardar la entrega en la tabla "tareas" 
    $sql = "
        INSERT INTO tareas (
            nombre_tarea, asignatura, nombre_profesor, nombre_alumno
        ) VALUES (
            '$nombre_tarea', '$asignatura', '$nombre_profesor', '$nombre_alumno'
        )
    ";

    return eduflow::consultaInsercion($sql);
}
