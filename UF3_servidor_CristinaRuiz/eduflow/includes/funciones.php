<?php
function comprobarVariables() {
    if (
        isset($_POST['nombre']) &&
        isset($_POST['usuario']) &&
        isset($_POST['perfil']) &&
        isset($_POST['contrasena'])
    ) {
        $nombre = trim($_POST['nombre']);
        $usuario = trim($_POST['usuario']);
        $perfil = trim($_POST['perfil']);
        $contrasena = trim($_POST['contrasena']);
        $contenido = true;
        return [$nombre, $usuario, $perfil, $contrasena, $contenido];
    } else {
        $contenido = false;
        return [null, null, null, null, $contenido];
    }
}
?>
