
<?php
$id=$_GET['id'];
include '../../conexion.php';
$sql=" DELETE FROM herramienta where id_Herramienta=$id ";
$rta= mysqli_query($conexion,$sql); 
if(!$rta){
    echo "No se eilimino ";
}else{
    header("location:reproducto.php");
}
?>