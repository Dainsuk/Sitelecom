<?php
$id=$_GET['id'];
$can=$_GET['can'];
include '../../conexion.php';

   
    $sql=" UPDATE miscelaneo SET Can_Misce=Can_Misce+1 where id_Misce = $id ";
    $rta= mysqli_query($conexion,$sql); 
    if(!$rta){
        echo "No se eilimino ";
    }else{
        header("location:reproducto.php");
    }



?>