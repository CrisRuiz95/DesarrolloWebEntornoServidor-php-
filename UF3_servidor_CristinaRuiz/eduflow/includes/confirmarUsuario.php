<?php include 'comprobarSesion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Verificación Usuario</title>
</head>
<body>
    
<?php
include 'cabeceraDashboard.php';
include "funciones.php";
list($nombre, $usuario, $perfil, $contrasena, $contenido) = comprobarVariables();
?>

<?php if ($contenido): ?>
    <section class="section_admin">
        <form action="/eduflow/altaUsuario.php" method="post">
            <h2>Confirmar Registro</h2>

            <div class="campo">
                <label style="width: 200px;">Nombre: <?php echo htmlspecialchars($nombre); ?></label>
                <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
            </div>
            
            <div class="campo">
                <label style="width: 200px;">Usuario: <?php echo htmlspecialchars($usuario); ?></label>
                <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>" required>
            </div>

            <div class="campo">
                <label style="width: 200px;">Perfil: <?php echo htmlspecialchars($perfil); ?></label>
                <input type="hidden" name="perfil" value="<?php echo htmlspecialchars($perfil); ?>" required>
            </div>

            <div class="campo">
                <label style="width: 200px;">Contraseña: <?php echo htmlspecialchars($contrasena); ?></label>
                <input type="hidden" name="contrasena" value="<?php echo htmlspecialchars($contrasena); ?>" required>
            </div>

            <div class="campo-boton">
                <button type="submit">Confirmar Datos</button>
                <button type="submit" formaction="/eduflow/crearUsuario.php">Corregir Datos</button>
            </div>
        </form>
    </section>

<?php else: ?>
    <section class="section_admin">
        <h1>Error en la recepción de datos</h1>
        <p>No se recibieron correctamente los datos del formulario.</p>
        <a href="crearUsuario.php">Volver al formulario</a>
    </section>
<?php endif; ?>

<?php include 'pie.html'; ?>
</body>
</html>
