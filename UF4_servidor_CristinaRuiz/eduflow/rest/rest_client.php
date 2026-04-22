<?php

echo "<h1>PRUEBAS API REST</h1>";

// Horario general
echo "<h2>Horario general</h2>";
echo file_get_contents("http://localhost/eduflow/rest/rest_server.php?op=horario");

// Buscar asignaturas por profesor
echo "<h2>Buscar asignaturas por profesor</h2>";
echo file_get_contents("http://localhost/eduflow/rest/rest_server.php?op=buscar_profesor&nombre=Carlos%20Ruiz");

// Listar asignaturas
echo "<h2>Asignaturas disponibles</h2>";
echo file_get_contents("http://localhost/eduflow/rest/rest_server.php?op=asignaturas");

?>
