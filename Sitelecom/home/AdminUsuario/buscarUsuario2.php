<?php
include "../../conexion.php";
$nombre=$_POST["valor"];

    $sql1 = "SELECT * FROM admi WHERE id_user = '$nombre'";
    $result2 = $conexion->query($sql1);
    if ($result2->num_rows > 0) {
        // Crear un array para almacenar los resultados
        $resultado = array();
        // Recorrer cada fila del resultado de la consulta
        while($row = $result2->fetch_assoc()) {
            // Añadir cada fila al array
            $resultado[] = $row;
        }
        // Devolver los datos en formato JSON
        echo json_encode($resultado);
    }
    else{
        echo $id_user;
    }

?>
 