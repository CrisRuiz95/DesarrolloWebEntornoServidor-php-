<?php
include __DIR__ . "/../../includes/comprobarSesion.php";
include "../view/cabecera.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - eduFlow</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>ERP eduFlow</h1>

<div class="panel-admin">
  
  <a class="iconos" href="usuariosLista.php">
    <img width="90" height="90" src="https://img.icons8.com/material-outlined/96/admin-settings-male.png" alt="admin-settings-male" style="margin-left:80px; filter: invert(1);" />
    <span class="texto-iconos" >Gestión de Usuarios</span>
</a>

  <a class="iconos" href="#">
    <img width="90" height="90" src="https://img.icons8.com/ios/100/calendar-plus.png" alt="calendar-plus" style="margin-left:80px; filter: invert(1);"/>
    <span class="texto-iconos">Gestión de Calendario</span>
</a>

  <a class="iconos" href="#">
    <img width="90" height="90" src="https://img.icons8.com/ios-filled/100/todo-list.png" alt="todo-list" style="margin-left:80px; filter: invert(1);"/>
    <span class="texto-iconos">Gestión de Tareas</span>
</a>

</div>
</div> <!-- cierra el container abierto en cabecera -->

</body>

</html>