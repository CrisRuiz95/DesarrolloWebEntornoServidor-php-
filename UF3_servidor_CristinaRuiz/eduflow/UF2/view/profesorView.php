<?php
// Verificamos que la sesión esté activa
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel del Profesor - eduFlow</title>

  <link rel="stylesheet" href="/eduflow/UF2/view/styles.css?v=<?php echo time(); ?>">
</head>

<body>
<?php include __DIR__ . "/cabecera.php"; ?> 

<!-- Mensaje de confirmación -->
<?php if (!empty($_SESSION['mensaje'])): ?>
  <p style="text-align:center; color:green; font-weight:bold;">
    <?= $_SESSION['mensaje']; ?>
  </p>
  <?php unset($_SESSION['mensaje']); ?>
<?php endif; ?>


<!-- Pestañas solo visibles al principio -->
<div class="pestanas">
  <button class="pestana" id="pestana-cal">Calendario</button>
  <button class="segunda_pestana pestana" id="pestana-gt">Gestión de tareas</button>
</div>

<div class="hr"></div>


<!-- Contenedor del calendario (OCULTO cuando iniciamos sesión en profesor) -->
<section id="sec-calendario" style="display:none;">

  <?php foreach ($diasOrden as $dia): ?>
    <?php if (!empty($porDia[$dia])): ?>
      <?php foreach ($porDia[$dia] as $cl): ?>

        <article class="seccion-edu seccion-edu--calendar prof-seccion">
            <header class="seccion-edu__head_profesor">
              <span> <?= ($dia) ?> </span>
            </header>
            
          <div class="seccion-edu__body_profesor">
            <p class="espacio_profesor">
              <span class="espacio_profesor__etiqueta">Asignatura:</span>
              <?= ($cl['asignatura']) ?>
            </p>
            <p class="espacio_profesor"><span class="espacio_profesor__etiqueta">Profesor/a:</span> <?= ($cl['profesor']) ?></p>
            <p class="espacio_profesor"><span class="espacio_profesor__etiqueta">Hora:</span> <?= ($cl['hora']) ?></p>
            <p class="espacio_profesor"><span class="espacio_profesor__etiqueta">Aula:</span> <?= ($cl['aula']) ?></p>
          </div>
        </article>

      <?php endforeach; ?>
    <?php endif; ?>
  <?php endforeach; ?>
</section>

  <!-- Sección: Gestión de tareas -->
<section id="sec-tareas" style="display:none; margin-top:40px;">
  <h2>Tareas entregadas</h2>

  <?php if (!empty($_SESSION['mensaje'])): ?>
    <p style="color:green; font-weight:bold; text-align:center;">
      <?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
    </p>
  <?php endif; ?>

  <?php if (!empty($tareas_entregadas)): ?>
    <table class="tabla-usuarios" style="width:100%; text-align:left;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Alumno</th>
          <th>Asignatura</th>
          <th>Tarea</th>
          <th>Comentario</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tareas_entregadas as $t): ?>
          <tr>
            <td><?= htmlspecialchars($t['id_tarea']) ?></td>
            <td><?= htmlspecialchars($t['nombre_alumno']) ?></td>
            <td><?= htmlspecialchars($t['asignatura']) ?></td>
            <td><?= htmlspecialchars($t['nombre_tarea']) ?></td>
            <td>
              <?= $t['mensaje_profesor'] ? htmlspecialchars($t['mensaje_profesor']) : "<em>Sin comentario</em>" ?>
            </td>
            <td>
              <form method="post" action="../controller/profesorController.php" class="form-mensaje_profesor">
                <input type="hidden" name="id_tarea" value="<?= htmlspecialchars($t['id_tarea']) ?>">
                <input type="text"
                       name="mensaje_profesor"
                       placeholder="Añadir comentario..."
                       value="<?= htmlspecialchars($t['mensaje_profesor']) ?>"
                       class="input-mensaje_profesor">
                <button type="submit" class="btn-guardar">Guardar</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No hay tareas entregadas todavía.</p>
  <?php endif; ?>
</section>

  

</section>

<!-- Esto es un javascript que permite que cuando le demos a calendario aparezca la información, mientras tanto se mostrará oculto  -->
<script>

  const pestanaCal = document.getElementById('pestana-cal');
  const pestanaGt  = document.getElementById('pestana-gt');
  const secCal = document.getElementById('sec-calendario');
  // Definimos el apartado de gestión de tareas con "sección-tareas"
  const secTareas = document.getElementById('sec-tareas');


  pestanaCal.addEventListener('click', () => {
    secCal.style.display = 'block';
    secTareas.style.display = 'none';
    pestanaCal.classList.add('is-active');
    pestanaGt.classList.remove('is-active');
  });

  // Evento del botón "Gestión de tareas"
  pestanaGt.addEventListener('click', () => {
  // Ocultar calendario y mostrar gestión de tareas
  secCal.style.display = 'none';
  secTareas.style.display = 'block';

  pestanaCal.classList.remove('is-active');
  pestanaGt.classList.add('is-active');
});


</script>
</div> <!-- cierra el container abierto en cabecera -->
</body>
</html>