<?php
include_once __DIR__ . "/../../includes/comprobarSesion.php";
include_once __DIR__ . "/../../modelo/bd/mysql.php";

// Definimos primero la función que carga el XML
function cargar_datos_xml() {
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

// Llamamos a la función correctamente
$xml = cargar_datos_xml();

// ✅ 3. Procesar el XML
$clases = [];
if ($xml && isset($xml->clases->clase)) {
    foreach ($xml->clases->clase as $c) {
        $clases[] = [
            'asignatura' => (string)$c->asignatura,
            'profesor'   => (string)$c->profesor,
            'dia'        => (string)$c->dia,   
            'hora'       => (string)$c->hora,
            'aula'       => (string)$c->aula,
        ];
    }
}

// Creamos array, agrupamos por día 
$diasOrden = ['LUNES','MARTES','MIÉRCOLES','JUEVES','VIERNES']; 
$porDia = []; 
foreach ($clases as $cl) { 
  //Esto ignora las mayusculas y lo hace compatible con los acentos 
  $d = mb_strtoupper($cl['dia'], 'UTF-8'); 
  if ($d === 'MIERCOLES') $d = 'MIÉRCOLES'; 
  $porDia[$d][] = $cl; 
}

//Cargar tareas entregadas desde la BD
$nombreProfesor = $_SESSION['usuario']['nombre_completo'];
$sql = "SELECT id_tarea, nombre_tarea, asignatura, nombre_alumno, mensaje_profesor
        FROM tareas 
        WHERE nombre_profesor = '$nombreProfesor'
        ORDER BY id_tarea DESC";

$tareas_entregadas = eduflow::consultaLectura($sql);
?>
