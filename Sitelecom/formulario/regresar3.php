<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Devolver Material</title>
</head>
<body>

<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $encargado = $_POST['encargado'];

    include '../conexion.php';

    // Función para devolver materiales
    function devolverMaterial($conexion, $tabla, $campoCantidad, $campoDescri, $encargado) {
        $sql = "SELECT * FROM $tabla WHERE encargado = ? AND $campoCantidad >= 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $encargado);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cantidad = $row[$campoCantidad];
                $descripcion = $row[$campoDescri];

                // Actualizar tabla general
                $sql_update_general = "UPDATE equipo_epp SET Can_EPP = Can_EPP + ? WHERE Des_EPP = ?";
                $stmt_update_general = $conexion->prepare($sql_update_general);
                $stmt_update_general->bind_param("is", $cantidad, $descripcion);
                if ($stmt_update_general->execute()) {
                    // Eliminar de tabla de asignación
                    $sql_delete = "DELETE FROM $tabla WHERE encargado = ? AND $campoDescri = ?";
                    $stmt_delete = $conexion->prepare($sql_delete);
                    $stmt_delete->bind_param("ss", $encargado, $descripcion);
                    $stmt_delete->execute();
                }
            }
        }
    }

    // Devolver EPP
    devolverMaterial($conexion, "asig_epp", "cantidad_EPP", "Descri_EPP", $encargado);

    // Devolver Herramienta
    devolverMaterial($conexion, "asig_herramienta", "cantidad_Herra", "Descri_Herra", $encargado);

    // Devolver Misceláneo
    $sql_miscelaneo = "SELECT * FROM asig_miscelaneo WHERE encargado = ? AND cantidad_Misce >= 0";
    $stmt_miscelaneo = $conexion->prepare($sql_miscelaneo);
    $stmt_miscelaneo->bind_param("s", $encargado);
    $stmt_miscelaneo->execute();
    $result_miscelaneo = $stmt_miscelaneo->get_result();

    if ($result_miscelaneo->num_rows > 0) {
        while ($row = $result_miscelaneo->fetch_assoc()) {
            $cantidad_Misce = $row['cantidad_Misce'];
            $Descri_Misce = $row['Descri_Misce'];

            // Actualizar tabla general
            $sql_update_miscelaneo = "UPDATE miscelaneo SET Can_Misce = Can_Misce + ? WHERE Des_Misce = ?";
            $stmt_update_miscelaneo = $conexion->prepare($sql_update_miscelaneo);
            $stmt_update_miscelaneo->bind_param("is", $cantidad_Misce, $Descri_Misce);
            if ($stmt_update_miscelaneo->execute()) {
                // Eliminar de tabla de asignación
                $sql_delete_miscelaneo = "DELETE FROM asig_miscelaneo WHERE encargado = ? AND Descri_Misce = ?";
                $stmt_delete_miscelaneo = $conexion->prepare($sql_delete_miscelaneo);
                $stmt_delete_miscelaneo->bind_param("ss", $encargado, $Descri_Misce);
                $stmt_delete_miscelaneo->execute();
            }
        }
    }

    // Verificar si ya no hay materiales asignados al encargado
    $sql_verificar_asignaciones = "SELECT * FROM asig_epp WHERE encargado = ? LIMIT 1";
    $stmt_verificar_asignaciones = $conexion->prepare($sql_verificar_asignaciones);
    $stmt_verificar_asignaciones->bind_param("s", $encargado);
    $stmt_verificar_asignaciones->execute();
    $result_verificar_asignaciones = $stmt_verificar_asignaciones->get_result();

    if ($result_verificar_asignaciones->num_rows == 0) {
        // Si ya no hay asignaciones, eliminar el encargado de 'lideres'
        $sql_delete_encargado = "DELETE FROM lideres WHERE encargado = ?";
        $stmt_delete_encargado = $conexion->prepare($sql_delete_encargado);
        $stmt_delete_encargado->bind_param("s", $encargado);
        $stmt_delete_encargado->execute();
    }

    // Actualizar 'regreso' en 'reportlideres'
    $sql_reportlideres = "UPDATE reportlideres SET regreso = CURDATE() WHERE encargado = ?";
    $stmt_reportlideres = $conexion->prepare($sql_reportlideres);
    $stmt_reportlideres->bind_param("s", $encargado);
    $stmt_reportlideres->execute();

    $conexion->close();

    echo "<script>
            Swal.fire({
                icon: 'success',
                text: 'Material devuelto exitosamente',
                timer: 2500,
                timerProgressBar: false,
                showConfirmButton: false
            }).then(() => {
                window.location.href = '../home/mostrar.php';
            });
          </script>";
} else {
    echo "<script>
            Swal.fire({
                icon: 'error',
                text: 'Acceso denegado',
                timer: 2500,
                timerProgressBar: false,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'regresar.php';
            });
          </script>";
}
?>
</body>
</html>
