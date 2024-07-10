<?php
include '../conexion.php';

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$query1 = "SELECT Des_EPP, Can_EPP, CanG_EPP FROM equipo_epp";
$result1 = $conexion->query($query1);

$query2 = "SELECT Des_Herra, Can_Herra, CanG_Herra FROM herramienta";
$result2 = $conexion->query($query2);

$query3 = "SELECT Des_Misce, Can_Misce FROM miscelaneo";
$result3 = $conexion->query($query3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../font/bootstrap-icons.css">
    <title>menuprincipal</title>
    <style>
        table {
            width: 50%;
            text-align: center;
        }

        th {
            color: #000080;
        }

        td {
            background-color: transparent;
        }

        .existencia-verde {
            background-color: #00ff00;
        }

        .existencia-amarilla {
            background-color: yellow;
        }

        .existencia-roja {
            background-color: red;
        }

        .$class{
            text-align:center;
        }
    </style>
</head>
<body>
    <header>
        <!-- Tu contenido anterior -->
        <div class="contenedor">
            <table class="table table-striped">
                <tr>
                    <th>Equipo de EPP</th>
                    <th style='text-align:center;'>Existencias EPP Para Asignar</th>
                    <th style='text-align:center;'>Existencias Generales EPP</th>
                </tr>

                <?php
                while ($row = $result1->fetch_assoc()) {
                    $cantidad = (int)$row["Can_EPP"];
                    $class = '';
                    $cantidad1 = (int)$row["CanG_EPP"];
                    $class1 = '';

                    if ($cantidad > 12) {
                        $class = 'existencia-verde';
                    } elseif ($cantidad <= 12 && $cantidad > 6) {
                        $class = 'existencia-amarilla';
                    } else {
                        $class = 'existencia-roja';
                    }

                  

                    echo "<tr><td>" . $row["Des_EPP"] . "</td><td style='text-align:center;' class='$class'>" . $row["Can_EPP"] . "</td><td style='text-align:center;' class='$class1'>" . $row["CanG_EPP"] . "</td></tr>";
                }
                ?>

                <tr>
                    <th>Herramienta</th>
                    <th style='text-align:center;'>Existencias de Herramienta Para Asignar</th>
                    <th style='text-align:center;'>Existencias de Herramienta General</th>
                </tr>

                <?php
                while ($row = $result2->fetch_assoc()) {
                    $cantidad = (int)$row["Can_Herra"];

                    $class = '';
                    if ($cantidad > 10) {
                        $class = 'existencia-verde';
                    } elseif ($cantidad <= 10 && $cantidad > 5) {
                        $class = 'existencia-amarilla';
                    } else {
                        $class = 'existencia-roja';
                    }

                    echo "<tr><td>" . $row["Des_Herra"] . "</td><td style='text-align:center;' class='$class'>" . $row["Can_Herra"] . "</td><td style='text-align:center;'>" . $row["CanG_Herra"] . "</td></tr>";
                }
                ?>

                <tr>
                    <th>Miscelaneo</th>
                    <th style='text-align:center;'>Existencias de Miscelaneo</th>
                    <th style='text-align:center;'></th>
                </tr>

                <?php
                while ($row = $result3->fetch_assoc()) {
                    $cantidad = (int)$row["Can_Misce"];

                    $class = '';
                    if ($cantidad > 70) {
                        $class = 'existencia-verde';
                    } elseif ($cantidad <= 70 && $cantidad > 50) {
                        $class = 'existencia-amarilla';
                    } else {
                        $class = 'existencia-roja';
                    }

                    echo "<tr><td>" . $row["Des_Misce"] . "</td><td style='text-align:center;' class='$class'>" . $row["Can_Misce"] . "</td><td></td></tr>";
                }
                ?>

            </table>
        </div>
    </header>
</body>
</html>
