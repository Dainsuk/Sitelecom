<?php
include "../../conexion.php";
$id_usuario=$_POST["valor"];

$sql1 = "DELETE FROM usuarios WHERE id_user = '$id_usuario'";
$result2 = $conexion->query($sql1);

if ($result2) {
    echo '1';
}
else{echo '0'; }

?>
