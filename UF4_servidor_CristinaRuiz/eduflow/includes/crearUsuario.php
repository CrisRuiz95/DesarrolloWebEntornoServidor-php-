
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Registro usuario</title>
</head>
<body>
    
<?php


include 'cabeceraDashboard.php';
include "funciones.php";
list($nombre,$usuario,$perfil,$contrasena,$contenido) = comprobarVariables();
if ($contenido) {
    ?>
    <section class="section_admin">
        <form action="confirmarUsuario.php" method="post">
             <h2>Formulario de Registro</h2>
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
            </div>
            
            <div class="campo">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>" required>
            </div>
            <div class="campo">
      <label for="perfil">Perfil</label>
      <select id="perfil" name="perfil"  required>
        <option value="" >Seleccione un perfil</option>
        <option value="admin" <?= ($perfil === 'Administrador') ? 'selected' : '' ?>>Administrador</option>
        <option value="Profesor" <?= ($perfil === 'Profesor') ? 'selected' : '' ?> >Profesor</option>
        <option value="Estudiante"  <?= ($perfil === 'Estudiante') ? 'selected' : '' ?>>Estudiante</option>
      </select>
    </div>
            

            <div class="campo">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" value="<?php echo $contrasena; ?>" required>
            </div>

            <div class="campo-boton">
            <button type="submit">Enviar</button>

            </div>
        </form>
 
</section>
<?php
} else {
    
 ?>

<section class="section_admin">
        
        <form action="confirmarUsuario.php" method="post">
            <h2>Formulario de Registro</h2>
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
                <div class="campo">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
    
            <div class="campo">
      <label for="perfil">Perfil</label>
      <select id="perfil" name="perfil" required>
        <option value="" selected disabled>Seleccione un perfil</option>
        <option value="admin">Administrador</option>
        <option value="Profesor">Profesor</option>
        <option value="Estudiante">Estudiante</option>
      </select>
    </div>
           

            <div class="campo">
                <label for="contrasena">Contraseña:</label>
                <input type="text" id="contrasena" name="contrasena" required>
            </div>

            <div class="campo-boton">
                <button type="submit">Enviar</button>
            </div>
        </form>

</section>
<?php
}
include 'pie.html';
?>

</body>
</html>