<?php
$eppAsignado = false;
$herramientaAsignado = false;
$miscelaneoAsignado = false;

try {
    if (empty($_POST['proyecto']) || empty($_POST['escenario']) || empty($_POST['encargado'])) {
        echo "campos vacios";
        exit;
    }

    include '../conexion1.php';

    $proyecto_id = $_POST['proyecto'];
    $escenario_id = $_POST['escenario'];
    $encargado = trim($_POST['encargado']);

    // Consulta para obtener el nombre del proyecto
    $proyecto_stmt = $conexion->prepare("SELECT nombre FROM proyectos WHERE id = ?");
    $proyecto_stmt->execute([$proyecto_id]);
    $proyecto = $proyecto_stmt->fetchColumn();

    // Consulta para obtener el nombre del escenario
    $escenario_stmt = $conexion->prepare("SELECT nombre FROM escenarios WHERE id = ?");
    $escenario_stmt->execute([$escenario_id]);
    $escenario = $escenario_stmt->fetchColumn();

    // Verificar si el encargado ya tiene asignaciones
    $checkIfExists = $conexion->prepare("SELECT COUNT(*) AS count FROM lideres WHERE encargado = ?");
    $checkIfExists->execute([$encargado]);
    $count = $checkIfExists->fetchColumn();

    if ($count > 0) {
        echo "asignado";
        exit;
    }

    // Verificar y registrar EPP
    $registroExitoso1 = true;
    $registroExitoso2 = true;
    $registroExitoso3 = true;
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'epp_') === 0) {
            $id_EPP = substr($key, 4);
            $cantidad = (int)$value;

            if ($cantidad > 0) {
                $stmt = $conexion->prepare("SELECT Des_EPP, Can_EPP FROM equipo_epp WHERE id_EPP = ?");
                $stmt->execute([$id_EPP]);
                $eppData = $stmt->fetch();

                if ($eppData) {
                    $currentQuantity = $eppData['Can_EPP'];
                    $updatedQuantity = $currentQuantity - $cantidad;
                    $descripcion_EPP = $eppData['Des_EPP'];

                    if ($updatedQuantity >= 0) {
                        $updateStmt = $conexion->prepare("UPDATE equipo_epp SET Can_EPP = ? WHERE id_EPP = ?");
                        $updateStmt->execute([$updatedQuantity, $id_EPP]);

                        $restaStmt = $conexion->prepare("INSERT INTO asig_epp (Descri_EPP, cantidad_EPP, encargado) VALUES (?, ?, ?)");
                        $restaStmt->execute([$descripcion_EPP, $cantidad, $encargado]);
                    } else {
                        $registroExitoso1 = false;
                    }
                }
            }
        }
    }

    // Verificar y registrar herramientas
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'herra_') === 0) {
            $id_herramienta = substr($key, 6);
            $cantidad_herramienta = (int)$value;

            if ($cantidad_herramienta > 0) {
                $stmt_herramienta = $conexion->prepare("SELECT Des_Herra, Can_Herra FROM herramienta WHERE id_Herramienta = ?");
                $stmt_herramienta->execute([$id_herramienta]);
                $herramientaData = $stmt_herramienta->fetch();

                if ($herramientaData) {
                    $currentQuantityHerramienta = $herramientaData['Can_Herra'];
                    $updatedQuantityHerramienta = $currentQuantityHerramienta - $cantidad_herramienta;
                    $descripcion_herramienta = $herramientaData['Des_Herra'];

                    if ($updatedQuantityHerramienta >= 0) {
                        $updateStmt_herramienta = $conexion->prepare("UPDATE herramienta SET Can_Herra = ? WHERE id_Herramienta = ?");
                        $updateStmt_herramienta->execute([$updatedQuantityHerramienta, $id_herramienta]);

                        $restaStmt_herramienta = $conexion->prepare("INSERT INTO asig_herramienta (Descri_Herra, cantidad_Herra, encargado) VALUES (?, ?, ?)");
                        $restaStmt_herramienta->execute([$descripcion_herramienta, $cantidad_herramienta, $encargado]);
                    } else {
                        $registroExitoso2 = false;
                    }
                }
            }
        }
    }
    // Verificar y registrar misceláneos
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'misce_') === 0) {
            $id_miscelaneo = substr($key, 6);
            $cantidad_miscelaneo = (int)$value;

            if ($cantidad_miscelaneo > 0) {
                $stmt_miscelaneo = $conexion->prepare("SELECT Des_Misce, Can_Misce FROM miscelaneo WHERE id_Misce = ?");
                $stmt_miscelaneo->execute([$id_miscelaneo]);
                $miscelaneoData = $stmt_miscelaneo->fetch();

                if ($miscelaneoData) {
                    $currentQuantityMiscelaneo = $miscelaneoData['Can_Misce'];
                    $updatedQuantityMiscelaneo = $currentQuantityMiscelaneo - $cantidad_miscelaneo;
                    $descripcion_miscelaneo = $miscelaneoData['Des_Misce'];

                    if ($updatedQuantityMiscelaneo >= 0) {
                        $updateStmt_miscelaneo = $conexion->prepare("UPDATE miscelaneo SET Can_Misce = ? WHERE id_Misce = ?");
                        $updateStmt_miscelaneo->execute([$updatedQuantityMiscelaneo, $id_miscelaneo]);

                        $restaStmt_miscelaneo = $conexion->prepare("INSERT INTO asig_miscelaneo (Descri_Misce, cantidad_Misce, encargado) VALUES (?, ?, ?)");
                        $restaStmt_miscelaneo->execute([$descripcion_miscelaneo, $cantidad_miscelaneo, $encargado]);
                    } else {
                        $registroExitoso3 = false;
                    }
                }
            }
        }
    }
    if ($registroExitoso1 && $registroExitoso2 && $registroExitoso3) {
        echo "Asignación Exitosa";
        date_default_timezone_set('America/Mexico_City');
        $currentDateTime = date('Y-m-d H:i:s');
        $estadoNA = 'NA';

        $insertLideres = $conexion->prepare("INSERT INTO lideres (proyecto, escenario, encargado, salida) VALUES (?, ?, ?, ?)");
        $insertLideres->execute([$proyecto, $escenario, $encargado, $currentDateTime]);

        $insertLideres1 = $conexion->prepare("INSERT INTO reportlideres (proyecto, escenario, encargado, salida, regreso) VALUES (?, ?, ?, ?, ?)");
        $insertLideres1->execute([$proyecto, $escenario, $encargado, $currentDateTime, $estadoNA]);
    } else {
        if (!$registroExitoso1) {
            echo 'no_epp';
            exit;
        }
        if (!$registroExitoso2) {
            echo 'no_herra';
            exit;
        }
        if (!$registroExitoso3) {
            echo 'no_misce';
            exit;
        }
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
