<?php
// Conexión a la base de datos (reemplaza los valores con los tuyos)
include "../conexion.php";

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recibir datos del formulario
$proyecto_id = $_POST['proyecto1'];
$escenario_id = $_POST['escenario1'];
$encargado = trim($_POST['encargado']);

if (empty($proyecto_id) && empty($escenario_id)) {
    echo "vacio";
    $conexion->close();
    exit;
}

try {
    // Consulta para obtener el nombre del proyecto
    $proyecto_stmt = $conexion->prepare("SELECT nombre FROM proyectos WHERE id = ?");
    $proyecto_stmt->bind_param("i", $proyecto_id); // "i" indica tipo entero
    $proyecto_stmt->execute();
    $proyecto_result = $proyecto_stmt->get_result();
    $proyecto_row = $proyecto_result->fetch_assoc();
    $proyecto = $proyecto_row['nombre'];

    // Consulta para obtener el nombre del escenario
    $escenario_stmt = $conexion->prepare("SELECT nombre FROM escenarios WHERE id = ?");
    $escenario_stmt->bind_param("i", $escenario_id); // "i" indica tipo entero
    $escenario_stmt->execute();
    $escenario_result = $escenario_stmt->get_result();
    $escenario_row = $escenario_result->fetch_assoc();
    $escenario = $escenario_row['nombre'];

    // Obtener la fecha de salida de la tabla lideres
    $salida_stmt = $conexion->prepare("SELECT salida FROM lideres WHERE encargado = ?");
    $salida_stmt->bind_param("s", $encargado);
    $salida_stmt->execute();
    $salida_result = $salida_stmt->get_result();
    $salida_row = $salida_result->fetch_assoc();
    $salida = $salida_row['salida'];

    // Actualizar la base de datos
    $update_stmt = $conexion->prepare("UPDATE lideres SET proyecto=?, escenario=? WHERE encargado=?");
    $update_stmt->bind_param("sss", $proyecto, $escenario, $encargado);

    if ($update_stmt->execute()) {
        echo "exito";

        // Actualizar también la tabla reportlideres si es necesario
        $update_report_stmt = $conexion->prepare("UPDATE reportlideres SET proyecto=?, escenario=? WHERE encargado=? AND salida=?");
        $update_report_stmt->bind_param("ssss", $proyecto, $escenario, $encargado, $salida);
        $update_report_stmt->execute();
        $update_report_stmt->close();
    } else {
        echo "Error en la actualización: " . $update_stmt->error;
    }

    $update_stmt->close();
    $proyecto_stmt->close();
    $escenario_stmt->close();
    $salida_stmt->close();
} catch (Exception $e) {
    echo "Excepción capturada: " . $e->getMessage();
}

$conexion->close();
?>
