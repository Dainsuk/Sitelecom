<?php
include '../conexion.php';

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
$query1 = "SELECT Des_EPP, Can_EPP FROM equipo_EPP";
$result1 = $conexion->query($query1);

$query2 = "SELECT Des_Herra, Can_Herra FROM herramienta";
$result2 = $conexion->query($query2);

$query3 = "SELECT Des_Misce, Can_Misce FROM miscelaneo";
$result3 = $conexion->query($query3);
echo "<table border='1'>";
    echo "<tr><th>Columna 1</th><th>Columna 2</th></tr>";
    
    while ($row = $result1->fetch_assoc()) {
        echo "<tr><td>" . $row["Des_EPP"] . "</td><td>" . $row["Can_EPP"] . "</td></tr>";
    }
    echo "<tr><th>Columna 1</th><th>Columna 2</th></tr>";
    while ($row = $result2->fetch_assoc()) {
        echo "<tr><td>" . $row["Des_Herra"] . "</td><td>" . $row["Can_Herra"] . "</td></tr>";
    }
    echo "<tr><th>Columna 1</th><th>Columna 2</th></tr>";
    while ($row = $result3->fetch_assoc()) {
        echo "<tr><td>" . $row["Des_Misce"] . "</td><td>" . $row["Can_Misce"] . "</td></tr>";
    }
    
    echo "</table>";
    ?>