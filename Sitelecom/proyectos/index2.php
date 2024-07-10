<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'sitelecom');

    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    $proyecto = $_POST['proyecto'];
    $escenarios = $_POST['escenarios'];

    // Validar que el campo de proyecto no esté vacío
    if (empty($proyecto)) {
        echo 'El campo de proyecto no puede estar vacío.';
    } else {
        // Verificar si al menos un escenario está presente
        $escenarioPresente = false;
        foreach ($escenarios as $escenario) {
            if (!empty($escenario)) {
                $escenarioPresente = true;
                break;
            }
        }

        if (!$escenarioPresente) {
            echo 'Debe ingresar al menos un escenario.';
        } else {
            // Verificar si el proyecto ya existe en la base de datos
            $proyectoExistente = false;
            $query = "SELECT id FROM proyectos WHERE nombre = '$proyecto'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $proyectoExistente = true;
                echo 'El proyecto ya está registrado.';
            }

            if (!$proyectoExistente) {
                // Insertar el proyecto en la tabla proyectos
                $sql = "INSERT INTO proyectos (nombre) VALUES ('$proyecto')";
                $conn->query($sql);

                $proyecto_id = $conn->insert_id;

                // Insertar los escenarios en la tabla escenarios
                foreach ($escenarios as $escenario) {
                    if (!empty($escenario)) {
                        $sql = "INSERT INTO escenarios (nombre, proyecto_id) VALUES ('$escenario', $proyecto_id)";
                        $conn->query($sql);
                    }
                }

                echo 'Registro exitoso.';
            }
        }
    }

    $conn->close();
}

?>