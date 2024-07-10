<?php
include "../../conexion.php";

// Obtén los datos del formulario
$nombre = $_POST["Nombre"];
$usu = $_POST["usu"];
$contra = $_POST["contra"];
$codigo = $_POST["contra1"];

// Prepara las consultas SQL utilizando parámetros para prevenir inyecciones SQL
$sql1 = "UPDATE usuarios SET Nombre = ?, Contraseña = ? WHERE Usu = ?";
$stmt1 = $conexion->prepare($sql1);
$stmt1->bind_param("sss", $nombre, $contra, $usu);
$result1 = $stmt1->execute();
$stmt1->close();

if ($result1) {
    echo '1';
} else {
    $sql2 = "UPDATE admi SET Nombre = ?, Contraseña = ? WHERE Usu = ?";
    $stmt2 = $conexion->prepare($sql2);
    $stmt2->bind_param("ssss", $nombre, $contra, $usu);
    $result2 = $stmt2->execute();
    $stmt2->close();

    if ($result2) {
        echo '1';
    } else {
        echo '0';
    }
}

// Cierra la conexión
$conexion->close();
?>
