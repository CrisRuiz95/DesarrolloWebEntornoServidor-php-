<?php
include_once "../../includes/comprobarSesion.php";
include_once "../../modelo/bd/mysql.php";

// Obtener todos los usuarios
$consulta = "SELECT id_usuario, nombre_usuario, nombre_completo, perfil FROM usuarios ORDER BY id_usuario ASC";
$usuarios = eduflow::consultaLectura($consulta);
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Usuarios - eduFlow</title>
  <!--Hemos añadido en el link del css un codigo que refresca el css cada vez que se carga la pagina para evitar problemas de cache -->
  <link rel="stylesheet" href="/eduflow/UF2/view/styles.css?v=<?php echo time(); ?>">
</head>
<body>


<?php include __DIR__ . "/cabecera.php"; ?>


<div class="contenedor-usuarios-admin">
  <h2><img src="https://img.icons8.com/ios-filled/50/107615/conference.png" style="vertical-align: middle; margin-right: 10px;"> Gestión de Usuarios</h2>

  <!--Tabla de usuarios -->
  <?php if ($usuarios && count($usuarios) > 0): ?>
    <table class="tabla-usuarios-admin">
      <thead>
        <tr>
          <th>ID</th>
          <th>Usuario</th>
          <th>Nombre Completo</th>
          <th>Perfil</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($usuarios as $u): ?>
        <tr>
          <td><?= htmlspecialchars($u['id_usuario']) ?></td>
          <td><?= htmlspecialchars($u['nombre_usuario']) ?></td>
          <td><?= htmlspecialchars($u['nombre_completo']) ?></td>
          <td><?= ucfirst(htmlspecialchars($u['perfil'])) ?></td>
          <td class="acciones">
                                                                        <!-- Esto se añadirá más adelante-->
            <a href="#" class="btn btn-editar"><img src="https://img.icons8.com/?size=100&id=AWPFmbr0eZkC&format=png&color=000000" alt="editar" width="25px"> Editar</a>
            <a href="#" class="btn btn-eliminar" onclick="return confirm('¿Seguro que quieres eliminar este usuario?');"><img src="https://img.icons8.com/?size=100&id=11984&format=png&color=000000" alt="Eliminar" width="25px"> Eliminar</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p class="no-usuarios">No hay usuarios registrados todavía.</p>
  <?php endif; ?>

  <div class="boton-volver">
    <a href="adminView.php" class="btn btn-volver"><img src="https://img.icons8.com/?size=100&id=bW8SsROsbth9&format=png&color=000000" width="40px" alt="flecha"></a>
  </div>
</div>

</body>
</html>
