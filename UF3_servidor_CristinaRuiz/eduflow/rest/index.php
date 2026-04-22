<?php
header("Content-Type: application/json");

$xmlFile = "../soap/empleados.xml"; // Ruta al archivo XML
$method = $_SERVER['REQUEST_METHOD'];
$pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : null;
$request = $pathInfo ? explode('/', trim($pathInfo, '/')) : [];

// Función para obtener empleados (listado completo o por DNI)
function getEmpleados($dni = null) {
    global $xmlFile;
    $xml = simplexml_load_file($xmlFile);

    $result = [];
    foreach ($xml->empleado as $empleado) {
        if ($dni === null || (string) $empleado->dni === $dni) {
            $result[] = [
                'dni' => (string) $empleado->dni,
                'nombre' => (string) $empleado->nombre,
                'apellido' => (string) $empleado->apellido,
                'puesto' => (string) $empleado->puesto,
            ];
        }
    }
    return $result;
}

// Función para añadir un empleado
function createEmpleado($data) {
    global $xmlFile;
    $xml = simplexml_load_file($xmlFile);

    // Verificar si el DNI ya existe
    foreach ($xml->empleado as $empleado) {
        if ((string) $empleado->dni === $data['dni']) {
            return ["error" => "El empleado con DNI {$data['dni']} ya existe."];
        }
    }

    $nuevoEmpleado = $xml->addChild('empleado');
    $nuevoEmpleado->addChild('dni', $data['dni']);
    $nuevoEmpleado->addChild('nombre', $data['nombre']);
    $nuevoEmpleado->addChild('apellido', $data['apellido']);
    $nuevoEmpleado->addChild('puesto', $data['puesto']);
    $xml->asXML($xmlFile);

    return ["message" => "Empleado creado correctamente."];
}

// Función para eliminar un empleado
function deleteEmpleado($dni) {
    global $xmlFile;
    $xml = simplexml_load_file($xmlFile);
    $index = 0;

    foreach ($xml->empleado as $empleado) {
        if ((string) $empleado->dni === $dni) {
            unset($xml->empleado[$index]);
            $xml->asXML($xmlFile);
            return ["message" => "Empleado eliminado correctamente."];
        }
        $index++;
    }
    return ["error" => "Empleado con DNI $dni no encontrado."];
}

// Procesar la solicitud según el método HTTP
if ($method === 'GET') {
    $dni = isset($request[0]) ? $request[0] : null;
    echo json_encode(getEmpleados($dni));
} elseif ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if ($data && isset($data['dni'], $data['nombre'], $data['apellido'], $data['puesto'])) {
        echo json_encode(createEmpleado($data));
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Datos inválidos para crear un empleado."]);
    }
} elseif ($method === 'DELETE') {
    $dni = isset($request[0]) ? $request[0] : null;
    if ($dni) {
        echo json_encode(deleteEmpleado($dni));
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Se requiere el DNI para eliminar un empleado."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}
?>