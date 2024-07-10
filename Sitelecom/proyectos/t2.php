<?php
$nombre_proyecto = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['proyecto_id'])) {
    $proyecto_id = $_POST['proyecto_id'];
    $nuevoNombreProyecto = isset($_POST['proyecto']) ? trim($_POST['proyecto']) : '';
    $nuevosEscenarios = isset($_POST['escenarios']) ? $_POST['escenarios'] : [];
    $nuevosEscenariosNombre = isset($_POST['nuevosEscenarios']) ? $_POST['nuevosEscenarios'] : [];

    if ($nuevoNombreProyecto === "") {
        die("El nombre del proyecto no puede estar vacío");
    } else {
       include '../conexion.php';
        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }

        $sql = "SELECT nombre FROM proyectos WHERE id = $proyecto_id";
        $result = $conexion->query($sql);

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $nombre_proyecto = $row['nombre'];

            if ($nuevoNombreProyecto !== $nombre_proyecto) {
                $sql = "SELECT id FROM proyectos WHERE TRIM(nombre) = '$nuevoNombreProyecto'";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    die("El nombre del proyecto ya está registrado");
                }

                $sql = "UPDATE proyectos SET nombre = '$nuevoNombreProyecto' WHERE id = $proyecto_id";
                $conexion->query($sql);
            }

            foreach ($nuevosEscenarios as $escenario_id => $nuevoEscenario) {
                $escenario_id = (int)$escenario_id;
                $nuevoEscenario = $conexion->real_escape_string(trim($nuevoEscenario));

                if ($escenario_id > 0) {
                    if (!empty($nuevoEscenario)) {
                        $sql = "SELECT id FROM escenarios WHERE TRIM(nombre) = '$nuevoEscenario' AND proyecto_id = $proyecto_id AND id != $escenario_id";
                        $result = $conexion->query($sql);

                        if ($result->num_rows > 0) {
                            die("El nombre del escenario ya está registrado en este proyecto");
                        }

                        $sql = "UPDATE escenarios SET nombre = '$nuevoEscenario' WHERE id = $escenario_id";
                        $conexion->query($sql);
                    } else {
                        die("El campo de escenarios no puede quedar vacío");
                    }
                }
            }

            foreach ($nuevosEscenariosNombre as $nuevoEscenarioNombre) {
                $nuevoEscenarioNombre = $conexion->real_escape_string(trim($nuevoEscenarioNombre));
                if (!empty($nuevoEscenarioNombre)) {
                    $sql = "SELECT id FROM escenarios WHERE TRIM(nombre) = '$nuevoEscenarioNombre' AND proyecto_id = $proyecto_id";
                    $result = $conexion->query($sql);

                    if ($result->num_rows == 0) {
                        $sql = "INSERT INTO escenarios (nombre, proyecto_id) VALUES ('$nuevoEscenarioNombre', $proyecto_id)";
                        $conexion->query($sql);
                    } else {
                        die("El nombre del escenario ya está registrado en este proyecto");
                    }
                }
            }

            $conexion->close();

            // Si todas las actualizaciones e inserciones se han realizado con éxito, envía "exito".
            echo "exito";
        }
    }
}
?>