<?php

$id_user=$_POST["valor"];

$sql1 = "SELECT  *FROM usuarios WHERE id_user = '$id_user'";
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
else{echo $id_user; }

?>
