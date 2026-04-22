 <!-- Formulario para listar empleados -->
 <section>
        <h2>Listar Empleados</h2>
        <form method="GET" action="">
            <label for="dni">DNI (opcional):</label>
            <input type="text" name="dni" id="dni" placeholder="12345678A">
            <button type="submit">Listar</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['dni'])) {
            $dni = $_GET['dni'];
            $url = "http://localhost/ifp/uf4/VC1/rest/index.php/" . urlencode($dni);
        } else {
            $url = "http://localhost/ifp/uf4/VC1/rest/index.php";
        }

        $response = file_get_contents($url);
        $empleados = json_decode($response, true);

        echo "<ul>";
        foreach ($empleados as $empleado) {
            echo "<li>DNI: {$empleado['dni']}, Nombre: {$empleado['nombre']}, Apellido: {$empleado['apellido']}, Puesto: {$empleado['puesto']}</li>";
        }
        echo "</ul>";
        ?>
    </section>

    <!-- Formulario para crear un empleado -->
    <section>
        <h2>Crear Empleado</h2>
        <form method="POST" action="">
            <input type="hidden" name="action" value="create">
            <label for="dni">DNI:</label>
            <input type="text" name="dni" id="dni" required>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" required>
            <label for="puesto">Puesto:</label>
            <input type="text" name="puesto" id="puesto" required>
            <button type="submit">Crear</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
            $data = [
                "dni" => $_POST['dni'],
                "nombre" => $_POST['nombre'],
                "apellido" => $_POST['apellido'],
                "puesto" => $_POST['puesto']
            ];

            $options = [
                "http" => [
                    "header" => "Content-Type: application/json",
                    "method" => "POST",
                    "content" => json_encode($data),
                ],
            ];
            $context = stream_context_create($options);
            $url = "http://localhost/ifp/uf4/VC1/rest/index.php";
            $response = file_get_contents($url, false, $context);
            echo "<p>Respuesta: $response</p>";
        }
        ?>
    </section>

    <!-- Formulario para eliminar un empleado -->
    <section>
        <h2>Eliminar Empleado</h2>
        <form method="POST" action="">
            <input type="hidden" name="action" value="delete">
            <label for="eliminar_dni">DNI del empleado a eliminar:</label>
            <input type="text" name="eliminar_dni" id="eliminar_dni" required>
            <button type="submit">Eliminar</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
            $dni = $_POST['eliminar_dni'];
            $url = "http://localhost/ifp/uf4/VC1/rest/index.php/" . urlencode($dni);
            $options = [
                "http" => [
                    "method" => "DELETE",
                ],
            ];
            $context = stream_context_create($options);
            $response = file_get_contents($url, false, $context);
            echo "<p>Respuesta: $response</p>";
        }
        ?>
    </section>
</body>
</html>