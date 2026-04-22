<?php
// Aseguramos que la sesión está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Cabecera del dashboard -->
<header class="headerEdu">
    <div class="logoEdu">
        <span class="logo-negrita">edu</span><span class="logo-cursiva">Flow</span>
    </div>

    <div class="mensajeUser">
        <?php if (isset($_SESSION['usuario'])): ?>
            <?php
                $nombreUsuario = htmlspecialchars($_SESSION['usuario']['nombre_usuario'] ?? 'Invitado');
                $horaInicio = isset($_SESSION['tiempo'])
                    ? date("d/m/Y H:i:s", $_SESSION['tiempo'])
                    : date("d/m/Y H:i:s");
            ?>
            <p>
                Usuario: <strong><?= $nombreUsuario ?></strong>
                &nbsp;&nbsp; | &nbsp;&nbsp;
                Sesión iniciada: <?= $horaInicio ?>
                &nbsp;&nbsp; | &nbsp;&nbsp;
                <a href="/eduflow/sesiones/controlSesiones/cerrarSesion.php" class="enlace_sesion">Cerrar sesión</a>
            </p>
        <?php else: ?>
            <p>Sesión no iniciada</p>
        <?php endif; ?>
    </div>
</header>
