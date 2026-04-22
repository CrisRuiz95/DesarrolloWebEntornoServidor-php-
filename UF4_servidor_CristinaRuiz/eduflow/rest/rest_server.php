<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET");

// Ruta XML
$xmlPath = __DIR__ . "/../UF2/assets/eduFlow.xml";

if (!file_exists($xmlPath)) {
    echo json_encode(["error" => "XML no encontrado"]);
    exit;
}

$xml = simplexml_load_file($xmlPath);
$op = $_GET['op'] ?? '';

switch ($op) {

    /*********** HORARIO GENERAL ****************************/
    case "horario":
        $horario = [];

        foreach ($xml->clases->clase as $c) {
            $horario[] = [
                "asignatura" => (string)$c->asignatura,
                "profesor"   => (string)$c->profesor,
                "dia"        => (string)$c->dia,
                "hora"       => (string)$c->hora,
                "aula"       => (string)$c->aula
            ];
        }

        echo json_encode($horario, JSON_PRETTY_PRINT);
        break;


    /********BUSCAR ASIGNATURA POR PROFESOR **********************+***/
    case "buscar_profesor":
        $nombre = strtolower($_GET["nombre"] ?? "");
        $resultado = [];

        foreach ($xml->clases->clase as $c) {
            if (strtolower((string)$c->profesor) == $nombre) {
                $resultado[] = [
                    "asignatura" => (string)$c->asignatura,
                    "dia"        => (string)$c->dia,
                    "hora"       => (string)$c->hora,
                    "aula"       => (string)$c->aula
                ];
            }
        }

        echo json_encode($resultado, JSON_PRETTY_PRINT);
        break;


    /**************LISTAR ASIGNATURAS*******************************/
    case "asignaturas":
        $asignaturas = [];

        foreach ($xml->clases->clase as $c) {
            $asignaturas[] = (string)$c->asignatura;
        }

        echo json_encode(array_unique($asignaturas), JSON_PRETTY_PRINT);
        break;


    /********************OPERACIÓN NO RECONOCIDA***********************/
    default:
        echo json_encode([
            "error" => "Operación no válida",
            "operaciones" => ["horario", "buscar_profesor", "asignaturas"]
        ]);
}

?>
