<h2>Acceso</h2>

<!-- Salta un error de sesion antes de los parámetros de usuario y contraseña -->
<?php if (!empty($_SESSION['error'])): ?>
  <p class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>

<form method="POST" action="index.php" class="login-form">
 <label> <h3> Usuario </h3></label> 
  <input type="text" name="usuario"> 
 
  <label> <h3> Contraseña </h3></label>
  <input type="password" name="clave"> <br><br>
  <button type="submit" class="boton">Iniciar sesión</button>
</form>

</div> <!-- cierra el container abierto en cabecera -->
