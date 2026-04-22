<!-- En caso de no tener sesión iniciada o caducada accedemos al login -->
<div class="acceso">
      <h2>ACCESO</h2>
      <form action="sesiones/controlSesiones/validarSesion.php" method="post">
        <?php if(isset($_GET['login'])){//mensaje de error en la contraseña
          if($_GET['login']=='false'){
            echo '<div style="color:red;">¡Usuario o contraseña incorrectos!</div>';
          }
        }
        ?>
        <div class="campo">
          <label for="usuario">Usuario</label>
          <input type="text" id="usuario" name="usuario" required>
        </div>
        <div class="campo">
          <label for="contrasena">Contraseña</label>
          <input type="password" id="contrasena" name="contrasena" required>
        </div>
        <div class="campo-boton">
          <button type="submit">Enviar</button>
        </div>
      </form>
    </div>
  </div>
  </div>