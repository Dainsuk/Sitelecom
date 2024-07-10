<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
    header("location:../index.php");
}else{
    ?>
<!DOCTYPE html>
<html>
<head>
<title>Sitelecom-SGA</title>
    <link rel="icon" href="../logo1.png">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<div class="regresar">
    <div class="header__superior">
        <div class="t">
            <a href="../proyectos/index.php"><i class="bi bi-arrow-left-circle"></i></a>
        </div>
        <div class="imagen">
            <img src="../descargar.jpg">
        </div>
    </div>
    <div class="border"></div>

    <form method="post" action="regresar.php">
        <label for="encargado">Selecciona un encargado:</label>
        <select name="encargado">
            <?php
            include "../conexion.php";

            if ($conexion->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }

            $sql = "SELECT encargado FROM lideres";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['encargado'] . "'>" . $row['encargado'] . "</option>";
                }
            } else {
                echo "0 resultados";
            }

            $conexion->close();
            ?>
        </select>
        <input type="submit" value="Mostrar Material">
    </form>
    <div class="border"></div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['encargado'])) {
        $encargado = $_POST['encargado'];

        include "../conexion.php";

        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Mostrar EPP asignado
        $sql = "SELECT * FROM asig_epp WHERE encargado = ? AND cantidad_EPP >= 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $encargado);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<h2>EPP Asignado a la Brigada de: $encargado</h2>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<label for='descripcion'></label><label>" . $row['Descri_EPP'] . "</label>";
                echo "<label for='cantidad'></label><input style='text-align:center; color:grey; position: absolute; left:80%; width:4%;' type='text' name='cantidad_EPP' value='" . $row['cantidad_EPP'] . "' readonly><br><br>";
            }
        } else {
            echo "No se encontraron registros para el encargado seleccionado en la tabla Asig_EPP: $encargado";
        }

        echo "<div class='border'></div>";

        // Mostrar Herramienta asignada
        $sql = "SELECT * FROM asig_herramienta WHERE encargado = ? AND cantidad_Herra >= 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $encargado);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<h2>Herramienta Asignada a la Brigada de: $encargado</h2>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<label for='descripcion'></label><label>" . $row['Descri_Herra'] . "</label>";
                echo "<label for='cantidad'></label><input style='text-align:center; color:grey; position: absolute; left:80%; width:4%;' type='text' name='cantidad_Herra' value='" . $row['cantidad_Herra'] . "' readonly><br><br>";
            }
        } else {
            echo "No se encontraron registros para el encargado seleccionado en la tabla Asig_Herramienta: $encargado";
        }

        // Mostrar Misceláneo asignado
        $sql = "SELECT * FROM asig_miscelaneo WHERE encargado = ? AND cantidad_Misce >= 1";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $encargado);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<div class='border'></div>";
        ?>
        <form method="POST"  action="regresar.php" >
            <input type="hidden" name="encargado" value="<?php echo $encargado; ?>">
            <h2>Miscelaneo Asignado a la Brigada de: <?php echo $encargado; ?></h2>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nombreMiscelaneo = $row['Descri_Misce']; // Usa el nombre como identificador único
                    echo "<label for='descripcion'></label><label>" . $row['Descri_Misce'] . "</label>";
                    echo "<label for='cantidad'></label><input style='text-align:center; color:grey; position: absolute; left:80%; width:4%;' type='text' name='cantidad_Misce[$nombreMiscelaneo]' value='" . $row['cantidad_Misce'] . "' readonly>";
                    echo "<label for='cantidad'></label><input style='text-align:center; color:Black; position: absolute; left: 85%; width:4%;' type='text' name='nueva_cantidad_Misce[$nombreMiscelaneo]' ><br><br>";
                }
            } else {
                echo "No se encontraron registros para el encargado seleccionado en la tabla Asig_Miscelaneo: $encargado";
            }
            ?>

            <input type="submit" style="background-color: rgb(40, 190, 77);color: #fff; width: 80p%;border: none;border-radius: 3px; padding: 1% 1%;" value="Actualizar">
        </form>
        <?php

    }
    ?>

    <form method="POST" action="regresar3.php">
        <input type="hidden" name="encargado" value="<?php echo $encargado; ?>">
        <div class='border'></div>
        <input type="submit" style="background-color: #007bff;color: #fff; width: 80p%;border: none;border-radius: 3px; padding: 1% 1%;" value="Devolver Material">
    </form>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $encargado = $_POST['encargado'];

    include "../conexion1.php";

    $exitosa = false; // Variable para controlar si hubo al menos una actualización exitosa

    if (isset($_POST['nueva_cantidad_Misce']) && is_array($_POST['nueva_cantidad_Misce'])) {
        // Tu código que maneja el array aquí
    foreach ($_POST['nueva_cantidad_Misce'] as $nombreMiscelaneo => $nuevaCantidad) {
        // Permitir que el campo esté vacío
        if (is_numeric($nuevaCantidad) && $nuevaCantidad >= 0 ) {
            // Obtener la cantidad inicial del array $_POST['cantidad_Misce']
            $cantidadInicial = $_POST['cantidad_Misce'][$nombreMiscelaneo];
            if ($nuevaCantidad <= $cantidadInicial) {
                // Actualizar la cantidad en la base de datos
                $sql_update_miscelaneo = "UPDATE asig_miscelaneo SET cantidad_Misce = $nuevaCantidad WHERE Descri_Misce = '$nombreMiscelaneo' AND encargado = '$encargado'";

                if ($conexion->query($sql_update_miscelaneo) === TRUE) {
                    $exitosa = true;
                } else {
                    echo "Error al actualizar la cantidad para $nombreMiscelaneo: " . $conexion->error;
                }
            } else {

            }
        } else {
            echo "<script>Swal.fire({
                icon: 'info',
                text: 'la cantidad no puede superar a la asignada y no puede ser negativa',
                timer: 2500,
                timerProgressBar: false,
                showConfirmButton: false,
            });</script>";
        }
    }

    // Mensajes de éxito y error
    if ($exitosa) {
        echo "<script>Swal.fire({
            icon: 'success',
            text: 'Actualizacion Exitosa',
            timer: 2500,
            timerProgressBar: false,
            showConfirmButton: false,
        })
                .then(() => {
                    window.location.href = '../formulario/regresar.php';
                });</script>";
    } else {
        echo "error";
    }
} else {

}

    $conexion->close();

}
?>




</body>
</html>
<?php
}
?>
