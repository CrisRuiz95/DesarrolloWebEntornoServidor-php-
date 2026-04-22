<?php
session_start();

// Si hay sesión redirige y sale del login
if (isset($_SESSION['usuario'])) {
    $perfil = $_SESSION['usuario']['perfil'] ?? '';
    switch ($perfil) {
        case 'setup':
            header("Location: /eduflow/includes/dashboardAdmin.php");
            exit;
        case 'admin':
            header("Location: /eduflow/UF2/view/adminView.php");
            exit;
        case 'profesor':
            header("Location: /eduflow/UF2/controller/profesorController.php");
            exit;
        case 'estudiante':
            header("Location: /eduflow/UF2/controller/estudiantesController.php");
            exit;
        default:
            session_unset();
            session_destroy();
            header("Location: /eduflow/index.php");
            exit;
    }
}

// Si llega aquí, NO hay sesión: mostramos la página de login
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eduFlow - Inicio</title>
    <link rel="stylesheet" href="includes/styles.css">
</head>
<body>
<?php
include 'includes/cabecera.html';
// mostrar errores desde session
if (!empty($_SESSION['error_login'])) {
    echo "<div class='error'>" . htmlspecialchars($_SESSION['error_login']) . "</div>";
    unset($_SESSION['error_login']);
}
include 'includes/login.php';
include 'includes/pie.html';
?>
</body>
</html>
