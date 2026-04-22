<?php
//PAra cargar las tablas o los datos del archibo de eduFlow e incorporar la información para su posterior uso
function cargar_datos_xml(?string $archivo = null): ?SimpleXMLElement {
    
    if ($archivo === null) {
        $archivo = __DIR__ . '/../assets/eduFlow.xml';
    }
//si elarchivo no existe retorna null sino carga el fichero de xml
    if (!file_exists($archivo)) {
        return null;
    }

    return simplexml_load_file($archivo);
}



//Para validar usuarios convertimos en Strings los usuarios y passwords y asociamops el usuario a las contraseñas

function validar_usuario(string $u, string $p) {
  $usuarios = [
    "admin"      => "abcdef",
    "estudiante" => "123456",
    "profesor"   => "654321",
  ];
  if ($usuarios[$u] === $p) return $u; 
  return false;
}