<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de tareas</title>
    <link rel="stylesheet" href="../assets/soap_styles.css">
</head>
<body>

<h1>Listado de tareas</h1>

<table class="tabla-tareas">
    <thead>
        <tr>
            <th>ID</th>
            <th>Asignatura</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Fecha entrega</th>
            <th>Urgente</th>
            <th>Archivo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tareas as $t): ?>
        <tr>
            <td><?= $t["id"] ?></td>
            <td><?= $t["asignatura"] ?></td>
            <td><?= $t["titulo"] ?></td>
            <td><?= $t["descripcion"] ?></td>
            <td><?= $t["fecha_entrega"] ?></td>
            <td><?= $t["urgente"] ?></td>
            <td><?= $t["archivo"] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
