<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$id=$_GET['id'];
$can=$_GET['can'];
include '../../conexion.php';
if($can>=1){
    $sql=" UPDATE miscelaneo SET Can_Misce=Can_Misce-1 where id_Misce = $id ";
    $rta= mysqli_query($conexion,$sql); 
    if(!$rta){
        echo "No se eilimino ";
    }else{
        header("location:reproducto.php");
    }
}else{
    echo "<script>
    Swal.fire({
        icon: 'info',
        text:'No cuenta con unidades para realizar una baja',
        timer: 2500,
        timerProgressBar: false, 
        showConfirmButton: false,
    
        })
        .then(() => {
            window.location.href = 'reproducto.php';
        });
    </script>";
}


?>    
</body>
</html>
