<?php
include_once "includes/funciones.php";
include_once "modelo/bd/mysql.php";

list($nombre, $usuario, $perfil, $contrasena, $contenido) = comprobarVariables();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/styles.css">
    <title>Usuario Creado</title>
</head>
<body>

<?php include "includes/cabeceraDashboard.php"; ?>

<section class="section_admin">
<?php
if ($contenido) {

    // Bloqueo de cuando se va a crear el usuario "admin" con contraseña abcdef
    if (strtolower($usuario) === 'admin') {
        echo "<article class='centrado'>
                <h2 style='color:red;'>Usuario reservado</h2>
                <p>No se puede crear un usuario llamado <strong>admin</strong>.</p>
                <div style='margin-top: 25px;'>
                <a href='/eduflow/includes/crearUsuario.php' class='boton' 
                style='display:inline-block; padding:10px 20px; background-color:#e0e6f8; color:#001a66;
                        border-radius:10px; text-decoration:none; transition:background-color 0.3s;'>
                                                   Volver al formulario
                </a>
            </div>
            </article>";
        exit;
    }


    // Hasheamos contraseña de forma segura
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Comprobamos si el usuario ya existe en la base de datos
    $check = eduflow::consultaLectura("SELECT * FROM usuarios WHERE nombre_usuario = '$usuario'");

    if ($check === null) {
        //  Insertar el nuevo usuario
        $sql = "
            INSERT INTO usuarios (nombre_usuario, contrasena_hash, nombre_completo, perfil)
            VALUES ('$usuario', '$hash', '$nombre', '$perfilBD')
        ";

        if (eduflow::consultaInsercion($sql)) {
        echo "<article class='centrado' style='text-align:center; line-height:1.8;'>
            <h2 style='color:green;'>Registro Completado</h2>
            <p>El usuario <strong>" . htmlspecialchars($usuario) . "</strong> ha sido creado correctamente.</p>
            <p>Nombre completo: <strong>" . htmlspecialchars($nombre) . "</strong></p>
            <p>Perfil asignado: <strong>" . htmlspecialchars($perfilBD) . "</strong></p>
            <div style='margin-top: 25px;'>
                <a href='/eduflow/includes/crearUsuario.php' class='boton' 
                style='display:inline-block; padding:10px 20px; background-color:#e0e6f8; color:#001a66;
                        border-radius:10px; text-decoration:none; transition:background-color 0.3s;'>
                                                    CREAR OTRO USUARIO
                </a>
            </div>
            </article>";

        } else {
            echo "<article class='centrado'>
                    <h2 style='color:red;'> Error al guardar</h2>
                    <p>No se pudo insertar el usuario. Es posible que el nombre de usuario ya exista.</p>
                    <a href='/eduflow/includes/crearUsuario.php' class='boton'>Volver al formulario</a>
                  </article>";
        }
    } else {
       echo "<article class='centrado'>
        <h2 style='color:red;'>El usuario ya existe</h2>
        <p>El nombre de usuario <strong>" . htmlspecialchars($usuario) . "</strong> ya está en uso.</p>
        <div style='margin-top: 25px;'>
                <a href='/eduflow/includes/crearUsuario.php' class='boton' 
                style='display:inline-block; padding:10px 20px; background-color:#e0e6f8; color:#001a66;
                        border-radius:10px; text-decoration:none; transition:background-color 0.3s;'>
                                                   Volver al formulario
                </a>
            </div>
            </article>";

    }

} 

eduflow::cerrarConexion();
?>
</section>

<?php include "includes/pie.html"; ?>

</body>
</html>
