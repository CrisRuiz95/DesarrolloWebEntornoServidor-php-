<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<link rel="stylesheet" href="../view/styles.css">

<div class="container_cabecera">
  <div class="fila">
    <div class="logo">edu<em>Flow</em></div>

    <div class="userbar">
      <?php if (!empty($_SESSION['usuario'])): ?>
        <div class="htmlspecialchars"> 
          Usuario: <strong><?= htmlspecialchars($_SESSION['usuario']['nombre_usuario']) ?></strong>
          &nbsp;&nbsp; Hora inicio: <?= date('H:i') ?> 
        </div>

      
        <button style="margin-left:10px;">
          <a class="link" href="/eduflow/sesiones/controlSesiones/cerrarSesion.php">Cerrar sesión</a>
        </button>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="container">
<?php
if (isset($_GET['logout'])) {
  session_unset(); 
  session_destroy();
  header("Location: /eduflow/index.php");
  exit;
}
?>
