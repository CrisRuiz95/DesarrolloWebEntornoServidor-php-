
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Tiempo máximo de sesión (30 minutos)
$tiempo_maximo = 30 * 60;

// Si no hay usuario logueado, redirige al index
if (!isset($_SESSION['usuario'])) {
    header("Location: /eduflow/index.php");
    exit();
}

// Si la sesión ha caducado
if (isset($_SESSION['tiempo']) && (time() - $_SESSION['tiempo'] > $tiempo_maximo)) {
    session_unset();
    session_destroy();
    header("Location: /eduflow/index.php");
    exit();
}

// Actualizar tiempo de actividad
$_SESSION['tiempo'] = time();

?>

<!-- Script para evitar volver atrás con sesión -->
<script>
  window.addEventListener("pageshow", function (event) {
    // Si la página se carga desde la caché del navegador 
    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
      // Redirige al cierre de sesión
      window.location.href = "/eduflow/sesiones/controlSesiones/cerrarSesion.php";
    }
  });
</script>
