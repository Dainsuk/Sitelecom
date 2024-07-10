
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $encargado = $_POST['encargado'];
   
    include "../conexion.php";

    $exitosa = false; // Variable para controlar si hubo al menos una actualización exitosa

    foreach ($_POST['nueva_cantidad_Misce'] as $nombreMiscelaneo => $nuevaCantidad) {
        // Permitir que el campo esté vacío
        if (is_numeric($nuevaCantidad) && $nuevaCantidad >= 0 ) {
            // Obtener la cantidad inicial del array $_POST['cantidad_Misce']
            $cantidadInicial = $_POST['cantidad_Misce'][$nombreMiscelaneo];
            if ($nuevaCantidad <= $cantidadInicial) {
                // Actualizar la cantidad en la base de datos
                $sql_update_miscelaneo = "UPDATE asig_miscelaneo SET cantidad_Misce = $nuevaCantidad WHERE Descri_Misce = '$nombreMiscelaneo' AND encargado = '$encargado'";
                
                if ($conexion->query($sql_update_miscelaneo) === TRUE) {
                    $exitosa = true;
                } else {
                    echo "Error al actualizar la cantidad para $nombreMiscelaneo: " . $conexion->error;
                }
            } else {
                echo "Error: La nueva cantidad para $nombreMiscelaneo debe ser menor o igual a la cantidad inicial.";
            }
        } else {
            echo "Error: La nueva cantidad para $nombreMiscelaneo no es un número entero no negativo.";
        }
    }

    // Mensajes de éxito y error
    if ($exitosa) {
        echo "EXITO";
    } else {a
        echo "error";
    }

    $conexion->close();
    
}
?>

