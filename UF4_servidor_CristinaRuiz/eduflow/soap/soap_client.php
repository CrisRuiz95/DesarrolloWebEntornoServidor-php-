<?php
$options = [
    "location" => "http://localhost/eduflow/soap/soap_server.php",
    "uri"      => "http://localhost/eduflow/soap/"
];

$client = new SoapClient(null, $options);

// Obtener tareas desde SOAP
$tareas = $client->listarTareas();

// Cargar vista
include "view_tareas.php";

//Agregar tareas desde SOAP
//echo $client->crearTarea("Examen Global Final", "Estudiar los temas vistos en clase", "2025-01-30", "Matemáticas Generales", "si");

//Eliminar tareas desde SOAP
//echo $client->eliminarTarea("Matemáticas Generales");

?>