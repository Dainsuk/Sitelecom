<?php
$host = "localhost";
$nombre_usuario_bd = "root";
$nombre_base_datos = "sitelecom";

// Crear la conexión a la base de datos
$conexion = mysqli_connect($host, $nombre_usuario_bd, null, $nombre_base_datos);

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
?>
