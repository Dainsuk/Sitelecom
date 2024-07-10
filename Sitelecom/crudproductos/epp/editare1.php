<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $id = $_POST["id"];
    $des = $_POST["Des"];
    $exis = $_POST["exis"];
    $can = $_POST["exis1"];

    // Validaciones
    if (empty($des) || !preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ_\-\/',\"() ]+$/u", $des)) {
        echo "desN";
        exit();
    }
    

    if (!is_numeric($can) || $can < 0) {
        echo "CanN";
        exit();
    }else{
   
        include "../../conexion.php";
        
        $sql_check = "SELECT Des_EPP FROM equipo_epp WHERE id_EPP = $id";
        $result = mysqli_query($conexion, $sql_check);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nombre_actual = trim($row['Des_EPP']); // Eliminar espacios al inicio y final del nombre actual
    
            // Verificar si el nuevo nombre es diferente al nombre actual en la base de datos
            if ($des !== $nombre_actual) {
                // Verificar si ya existe un registro con un nombre similar (sin espacios adicionales)
                $sql_verify = "SELECT id_EPP FROM equipo_epp WHERE TRIM(Des_EPP) = TRIM('$des')";
                $result_verify = mysqli_query($conexion, $sql_verify);
    
                if ($result_verify && mysqli_num_rows($result_verify) > 0) {
                    echo "existe R";
                }else{
                   // Actualizar el registro con la cantidad de EPP
                    $sql_update = "UPDATE equipo_epp SET Des_EPP = '$des', Can_EPP=Can_EPP +$can,  CanG_EPP =CanG_EPP + $can WHERE id_EPP = $id";
                    $rta = mysqli_query($conexion, $sql_update);
                    echo"exito";
                }
            }else{
                $sql_update = "UPDATE equipo_epp SET  Can_EPP=Can_EPP +$can,  CanG_EPP =CanG_EPP + $can WHERE id_EPP = $id";
                $rta = mysqli_query($conexion, $sql_update);
                echo"exito";
            }            
    }
    // Conexión a la base de datos (reemplaza los valores con los de tu configuración)
 
    // Realizar la actualización en la base de datos
    }
}
?>
