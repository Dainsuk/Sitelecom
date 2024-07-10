<!DOCTYPE html>
<html>
<head>
    <title>Seleccionar Proyecto y Escenarios</title>
    <link rel="stylesheet" href="tu_estilo.css">
</head>
<body>
    <h2>Actualizacion de Proyectos y Escenarios</h2>

    <form method="post" action="t1.php">
        <label for="proyecto">Seleccionar Proyecto:</label>
        <select name="proyecto_id" id="proyecto">
            <?php
            // Conecta a la base de datos y obtiene la lista de proyectos
            include '../conexion.php';
            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }

            $sql = "SELECT id, nombre FROM proyectos";
            $result = $conexion->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
            }

            $conexion->close();
            ?>
        </select>

        <input type="submit" value="Seleccionar Proyecto">
    </form>
</body>
</html>
