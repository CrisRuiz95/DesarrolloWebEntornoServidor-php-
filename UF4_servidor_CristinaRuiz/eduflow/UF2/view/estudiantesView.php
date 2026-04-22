<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel del Estudiante - eduFlow</title>
  <link rel="stylesheet" href="/eduflow/UF2/view/styles.css?v=<?php echo time(); ?>">
</head>
<body>

<?php include __DIR__ . "/cabecera.php"; ?>

<div class="container">

<!-- Mensaje de que ya se ha enviado la tarea-->
<?php if (!empty($mensaje)): ?>
  <p style="text-align:center; color:green; font-weight:bold; margin:15px 0;">
    <?= $mensaje ?>
  </p>
<?php endif; ?>


  <!-- Mostrar materias -->
  <?php foreach ($materias as $m): ?>
    <section class="seccion-edu_profesor">
      <header class="seccion-edu__head_profesor seccion-edu__head--calendario">
        <span><?= htmlspecialchars($m['dia']) ?></span>
      </header>
      <div class="seccion-edu__body_profesor">
        <p class="espacio_profesor"><span class="espacio_profesor__etiqueta">Asignatura:</span> <?= htmlspecialchars($m['nombre']) ?></p>
        <p class="espacio_profesor"><span class="espacio_profesor__etiqueta">Profesor/a:</span> <?= htmlspecialchars($m['profesor']) ?></p>
        <p class="espacio_profesor"><span class="espacio_profesor__etiqueta">Hora:</span> <?= htmlspecialchars($m['hora']) ?></p>
        <p class="espacio_profesor"><span class="espacio_profesor__etiqueta">Aula:</span> <?= htmlspecialchars($m['aula']) ?></p>
      </div>
    </section>
  <?php endforeach; ?>

  <div style="height:6px; background:#008040; border-radius:6px; margin:50px 0;"></div>

  <!-- Mostrar tareas -->
  <?php foreach ($tareas as $t): ?>
    <section class="seccion-edu">
      <header class="seccion-edu__head seccion-edu__head--principal">
        <span>TAREA</span>
        <?php if ($t['urgente']): ?>
          <span class="urgente">Urgente</span>
        <?php endif; ?>
      </header>

      <div class="seccion-edu__body">
        <p class="espacio">
          <span class="espacio__label espacio__label--color">Fecha de entrega:</span>
          <?= htmlspecialchars($t['fecha_entrega']) ?>
        </p>

        <div class="tarea-detalle">
          <p><b>Materia:</b> <?= htmlspecialchars($t['materia']) ?></p>
          <p><b>Título:</b> <?= htmlspecialchars($t['titulo']) ?></p>
          <p><b>Profesor:</b> <?= htmlspecialchars($t['profesor']) ?></p>
          <p><b>Descripción:</b> <?= htmlspecialchars($t['descripcion']) ?></p>
        </div>

        <!-- Formulario de entrega por metodo post llamando a la funcion guardar_entrega-->
        <form method="post" class="tarea-acciones" style="margin-top:10px;">
          <input type="hidden" name="tarea_titulo" value="<?= htmlspecialchars($t['titulo']) ?>">
          <input type="hidden" name="profesor" value="<?= htmlspecialchars($t['profesor']) ?>">
          <input type="hidden" name="asignatura" value="<?= htmlspecialchars($t['materia']) ?>">
          <button type="submit" class="boton">ENTREGAR</button>
        </form>
      </div>
    </section>
  <?php endforeach; ?>

</div> <!-- Fin del container -->


</body>
</html>
