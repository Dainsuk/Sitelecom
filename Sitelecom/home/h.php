<?php
// cargar_escenarios.php

// Conexión a la base de datos (ajusta los valores de acuerdo a tu configuración)
include '../conexion1.php';

if (isset($_POST['proyecto_id'])) {
    $proyecto_id = $_POST['proyecto_id'];

    $stmt = $conexion->prepare("SELECT id, nombre FROM escenarios WHERE proyecto_id = :proyecto_id");
    $stmt->bindParam(':proyecto_id', $proyecto_id, PDO::PARAM_INT);
    $stmt->execute();
    $escenarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($escenarios);
}
