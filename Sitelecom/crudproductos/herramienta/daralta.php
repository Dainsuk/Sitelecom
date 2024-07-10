<?php
$id=$_GET['id'];
$can=$_GET['can'];
include '../../conexion.php';

   
    $sql=" UPDATE herramienta SET Can_Herra=Can_Herra+1 ,CanG_Herra=CanG_Herra+1  where id_Herramienta = $id ";
    $rta= mysqli_query($conexion,$sql); 
    if(!$rta){
        echo "No se eilimino ";
    }else{
        header("location:reproducto.php");
    }



?>