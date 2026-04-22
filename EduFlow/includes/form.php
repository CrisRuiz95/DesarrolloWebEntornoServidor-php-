<?php
if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['edad'])&& isset($_POST['cargo'])){

$nombre=$_POST['nombre'];
$apellidos =$_POST['apellidos'];
$direccion = $_POST['edad'];
$cargo =$_POST['perfil'];
$cargo =$_POST['password'];
?>

<section class="completo">
    <article class="centrado">
        <h2>Formulario de Registro</h2>
        <form action="Altaformulario.php" method="post">
            <div class="formulario-conjunto">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre;?>" required>
            </div>

            <div class="formulario-conjunto">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos;?>" required>
            </div>

            <div class="formulario-conjunto">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $direccion;?>" required>
            </div>

            <div class="formulario-conjunto">
                <label for="cargo">Cargo:</label>
                <input type="text" id="cargo" name="cargo" value="<?php echo $cargo;?>" required>
            </div>

            <div class="formulario-conjunto">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </article>
</section>

<?php 
} else {
    ?>
<section class="completo">
    <article class="centrado">
        <h2>Formulario de Registro</h2>
        <form action="Altaformulario.php" method="post">
            <div class="formulario-conjunto">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="formulario-conjunto">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required>
            </div>

            <div class="formulario-conjunto">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" required>
            </div>

            <div class="formulario-conjunto">
                <label for="cargo">Cargo:</label>
                <input type="text" id="cargo" name="cargo" required>
            </div>

            <div class="formulario-conjunto">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </article>
</section>
<?php
}
?>