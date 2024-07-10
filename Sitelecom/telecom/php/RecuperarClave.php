<?php
    include "../../conexion.php";
    mysqli_set_charset($conexion, 'utf8');
    $nombre = $_POST['NomUsuario'];

    $sql = "SELECT Contraseña FROM usuarios WHERE Usu = '" . $nombre . "'";
    $result = mysqli_query($conexion, $sql);
    
    if (!$result) {
        echo "Error en la consulta: " . mysqli_error($conexion);
    } else {
        while ($item = mysqli_fetch_assoc($result)) {
            
            echo $item['Contraseña'];
        }
    }

?>



