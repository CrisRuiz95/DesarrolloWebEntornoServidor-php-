<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eduflow/index</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>
<?php

include "includes/cabecera.html";


session_start();
if (isset($_SESSION['usuario']) && ($_SESSION['usuario'] == 'admin')){
include "includes/dashboard.php";

} else if (isset($_POST['usuario']) && isset($_POST['passwrd'])){
    if($_POST['usuario'] == "admin" && $_POST['passwrd'] == "abcdef"){
        $_SESSION['usuario'] = 'admin';
        include 'includes/dashboard.php';
    }
    } else { 
        include 'includes/Acceso.html';
    }

    include "includes/pie.html";
?>


</body>
</html>