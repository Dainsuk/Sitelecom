  <!DOCTYPE html>
<html>
<head>
    <title>Lista de Encargados</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
<div class="regresar">
    <div class="header__superior">
        <div class="t">
            <a href="../home/principal.php"><i class="bi bi-arrow-left-circle"></i></a>
        </div>
        <div class="imagen">
            <img src="../descargar.jpg">
        </div>
    </div>
    <div class="border"></div>

    <form method="get" action="regresar2.php">
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
    if (isset($_GET['encargado'])) {
        $encargado = $_GET['encargado'];

        include "../conexion.php";

        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Mostrar EPP asignado
        $sql = "SELECT * FROM asig_epp WHERE encargado = '$encargado' and cantidad_EPP >= 0";
        $result = $conexion->query($sql);

        echo "<h2>EPP Asignado a la Brigada de : $encargado </h2>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<label for='descripcion'></label><label>" . $row['Descri_EPP'] . "</label>";
                echo "<label for='cantidad'></label><input style=' text-align:center; color:grey; position: absolute; left:80%; width:4%;' type='text' name='cantidad_EPP' value='" . $row['cantidad_EPP'] . " 'readonly><br><br>";

                // Código para la suma directa en las tablas generales
               // $sql_update_epp = "UPDATE Equipo_EPP SET Can_EPP = Can_EPP + " . $row['cantidad_EPP'] . " WHERE Des_EPP = '" . $row['Descri_EPP'] . "'";
               // $conexion->query($sql_update_epp);
            }
        } else {
            echo "No se encontraron registros para el encargado seleccionado en la tabla Asig_EPP: $encargado";
        }

        echo "<div class='border'></div>";

        // Mostrar Herramienta asignada
        $sql1 = "SELECT * FROM asig_herramienta WHERE encargado = '$encargado' and cantidad_Herra >= 0";
        $result1 = $conexion->query($sql1);

        echo "<h2>Herramienta Asignada a la Brigada de : $encargado </h2>";

        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                echo "<label for='descripcion'></label><label>" . $row1['Descri_Herra'] . "</label>";
                echo "<label for='cantidad'></label><input style=' text-align:center; color:grey; position: absolute; left:80%; width:4%;' type='text' name='cantidad_Herra' value='" . $row1['cantidad_Herra'] . " 'readonly><br><br>";

                // Código para la suma directa en las tablas generales
               // $sql_update_herra = "UPDATE Herramienta SET Can_Herra = Can_Herra + " . $row1['cantidad_Herra'] . " WHERE Des_Herra = '" . $row1['Descri_Herra'] . "'";
                //$conexion->query($sql_update_herra);
            }
        } else {
            echo "No se encontraron registros para el encargado seleccionado en la tabla Asig_Herramienta: $encargado";
        }

        $sql2 = "SELECT * FROM asig_miscelaneo WHERE encargado = '$encargado' and cantidad_Misce >= 0";
        $result2 = $conexion->query($sql2);
        echo "<div class='border'></div>";
    ?>
    <form method="POST" action="tu_pagina_de_destino.php">
    <h2>Miscelaneo Asignado a la Brigada de : <?php echo $encargado; ?></h2>

    <?php
    if ($result2->num_rows > 0) {
        while ($row2 = $result2->fetch_assoc()) {
            $nombreMiscelaneo = $row2['Descri_Misce']; // Usa el nombre como identificador único
            echo "<label for='descripcion'></label><label>" . $row2['Descri_Misce'] . "</label>";
            echo "<label for='cantidad'></label><input style='text-align:center; color:grey; position: absolute; left:80%; width:4%;' type='text' name='cantidad_Misce[$nombreMiscelaneo]' value='" . $row2['cantidad_Misce'] . "' readonly>";
            echo "<label for='cantidad'></label><input style='text-align:center; color:Black; position: absolute; left: 85%; width:4%;' type='text' name='cantidad_Misce[$nombreMiscelaneo]' ><br><br>";
        }
    } else {
        echo "No se encontraron registros para el encargado seleccionado en la tabla Asig_Miscelaneo: $encargado";
    }
    ?>

    <input type="hidden" name="encargado" value="<?php echo $encargado; ?>">
    <input type="submit" value="Actualizar">
</form>
<?php


        $conexion->close();
    }
    ?>


    <form method="POST" action="regresar3.php">
        <input type="hidden" name="encargado" value="<?php echo $encargado; ?>">
        <div class='border'></div>
        <input type="submit" value="Regresar">
    </form>
</div>
</body>
</html>
