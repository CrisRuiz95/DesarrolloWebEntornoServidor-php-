<?php
$options = [
    "location" => "http://localhost/eduflow/soap/soap_server.php",
    "uri"      => "http://localhost/eduflow/soap/"
];

$client = new SoapClient(null, $options);

// Ejemplo: listar tareas
$tareas = $client->listarTareas();
print_r($tareas);

// Ejemplo: crear tarea
// echo $client->crearTarea("Examen", "Repasar temas 1-4", "2025-01-30", "Matemáticas", "no");

// Ejemplo: eliminar tarea por asignatura
// echo $client->eliminarTarea("Matemáticas");
?>
