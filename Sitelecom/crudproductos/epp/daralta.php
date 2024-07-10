<?php
$id=$_GET['id'];
$can=$_GET['can'];
include '../../conexion.php';

   
    $sql=" UPDATE equipo_EPP SET Can_EPP=Can_EPP+1, CanG_EPP=CanG_EPP+1 where id_EPP = $id ";
    $rta= mysqli_query($conexion,$sql); 
    if(!$rta){
        echo "NO se dio de alta ";
    }else{
        header("location:reproducto.php");
    }



?>