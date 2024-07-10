<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sitelecom";
// Crear la conexión a la base de datos
$conexion = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>