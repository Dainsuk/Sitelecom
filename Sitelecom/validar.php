<?php
// Conectarse a la base de datos (reemplaza estos datos con los tuyos)
include 'conexion.php';

session_start();

// Obtener los datos del formulario
$usuario = $_POST["usuario"];
$contrasena = $_POST["contrasena"];


if($usuario=="" || $contrasena=="" ){
    echo "Campos Vacios";
}else{
    $sql = "SELECT * FROM usuarios WHERE Usu = '$usuario' AND Contraseña = '$contrasena'";
    $result = $conexion->query($sql);


    
    if ($result->num_rows > 0 ) {

        $sql1 = "SELECT Nombre FROM usuarios WHERE Usu = '$usuario' AND Contraseña = '$contrasena'";
        $result2 = $conexion->query($sql1);
        $fila = $result2->fetch_assoc();
        $sql3 = "SELECT id_user FROM usuarios WHERE Usu = '$usuario' AND Contraseña = '$contrasena'";
        $result3 = $conexion->query($sql3);
        $fila3 = $result3->fetch_assoc();

        $sql4 = "SELECT Usu FROM usuarios WHERE Usu = '$usuario' AND Contraseña = '$contrasena'";
        $result4 = $conexion->query($sql4);
        $fila4 = $result4->fetch_assoc();

        $sql5 = "SELECT Contraseña FROM usuarios WHERE Usu = '$usuario' AND Contraseña = '$contrasena'";
        $result5 = $conexion->query($sql5);
        $fila5 = $result5->fetch_assoc();

      

        echo "exito";
       $_SESSION['username']=$fila;
         $_SESSION['Usu']=$fila4; 
       $_SESSION['id_user']=$fila3; 
       $_SESSION['username']=$fila;
       $_SESSION['Contraseña']=$fila5;
     


      
    } else {
        $sql1 = "SELECT * FROM admi WHERE Usu = '$usuario' AND Contraseña = '$contrasena'";
        $result1 = $conexion->query($sql1);

        if($result1->num_rows > 0){
            $sql1 = "SELECT Nombre FROM admi WHERE Usu = '$usuario' AND Contraseña = '$contrasena'";
            $result2 = $conexion->query($sql1);
            $fila = $result2->fetch_assoc();
            $sql3 = "SELECT id_user FROM admi WHERE Usu = '$usuario' AND Contraseña = '$contrasena'";
            $result3 = $conexion->query($sql3);
            $fila3 = $result3->fetch_assoc();
    
            $sql4 = "SELECT Usu FROM admi WHERE Usu = '$usuario' AND Contraseña = '$contrasena'";
            $result4 = $conexion->query($sql4);
            $fila4 = $result4->fetch_assoc();
    
            $sql5 = "SELECT Contraseña FROM admi WHERE Usu = '$usuario' AND Contraseña = '$contrasena'";
            $result5 = $conexion->query($sql5);
            $fila5 = $result5->fetch_assoc();
    
            $sql6 = "SELECT codigo FROM admi WHERE Usu = '$usuario' AND Contraseña = '$contrasena'";
            $result6 = $conexion->query($sql6);
            $fila6 = $result6->fetch_assoc();
    
            echo "exito";
            $_SESSION['username']=$fila;
              $_SESSION['Usu']=$fila4; 
            $_SESSION['id_user']=$fila3; 
            $_SESSION['username']=$fila;
            $_SESSION['Contraseña']=$fila5;
            $_SESSION['codigo']=$fila6;

        }else{
            echo "error";
        }
        // La validación falla
        
    }
}
// Realizar la validación en la base de datos (reemplaza esto con tu propia lógica de validación)


$conexion->close();
?>
