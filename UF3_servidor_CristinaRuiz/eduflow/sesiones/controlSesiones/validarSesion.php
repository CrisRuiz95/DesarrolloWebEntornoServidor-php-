<?php
require_once '../../modelo/bd/mysql.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');

    // Validación básica
    if ($usuario === '' || $contrasena === '') {
        echo "<p style='color:red'>Por favor, introduce usuario y contraseña.</p>";
        exit;
    }

    // 1️. Caso especial: admin inicial sin BD (admin / abcdef)
    // Se usa solo para acceder al panel de crear usuarios
    if ($usuario === 'admin' && $contrasena === 'abcdef') {
        $consultaAdmin = "SELECT * FROM usuarios WHERE nombre_usuario = 'admin'";
        $existeAdmin = eduflow::consultaLectura($consultaAdmin);

        // Si NO existe el usuario admin en la BD, accede al dashboard de creación
        if (!$existeAdmin || count($existeAdmin) === 0) {
            $_SESSION['usuario'] = [
                'nombre_usuario' => 'admin_inicial',
                'nombre_completo' => 'Administrador de configuración',
                'perfil' => 'setup'
            ];
            $_SESSION['tiempo'] = time();

            header("Location: ../../includes/dashboardAdmin.php");
            exit;
        }
        // Si sí existe, se tratará como un usuario normal más abajo
    }

    // 2️. Caso general: buscar usuario en la BD
    $consulta = "SELECT * FROM usuarios WHERE nombre_usuario = '$usuario'";
    $resultado = eduflow::consultaLectura($consulta);

    if ($resultado && count($resultado) > 0) {
        $user = $resultado[0];

        // Verificar contraseña
        if (password_verify($contrasena, $user['contrasena_hash'])) {

            // Iniciar sesión
            $_SESSION['usuario'] = [
                'id_usuario' => $user['id_usuario'],
                'nombre_usuario' => $user['nombre_usuario'],
                'nombre_completo' => $user['nombre_completo'],
                'perfil' => $user['perfil']
            ];
            $_SESSION['tiempo'] = time();

            // Redirigir según el perfil o rol
            switch ($user['perfil']) {
                case 'admin':
                    header("Location: ../../UF2/view/adminView.php");
                    break;
                case 'profesor':
                    header("Location: ../../UF2/controller/profesorController.php");
                    break;
                case 'estudiante':
                    header("Location: ../../UF2/controller/estudiantesController.php");
                    break;
                default:
                    echo "<p style='color:red'>Perfil no reconocido.</p>";
            }
            exit;

        } else {
            //Cuando la contraseña es incorrecta
            $_SESSION['error_login'] = "Contraseña incorrecta.";
            header("Location: ../../index.php");
            exit;
        }

    } else {
        //Cuando el usuario no existe
        $_SESSION['error_login'] = "Usuario no encontrado.";
        header("Location: ../../index.php");
        exit;
    }
}
?>
