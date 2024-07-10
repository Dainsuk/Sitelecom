<?php
$Des=$_POST['Des'];
$exis=$_POST['exis'];

include '../../conexion.php';
function letras($texto) {
    
    return preg_match('/[a-zA-Z]/', $texto) === 1;
}
function entero($valor) {
    // Utilizamos la función is_int para verificar si el valor es un número entero
    // Además, podemos usar is_numeric para asegurarnos de que sea un número en general
    return filter_var($valor, FILTER_VALIDATE_INT) !== false;
}


$sql1 = "SELECT * FROM equipo_epp WHERE Des_EPP = '$Des'";
$resul = mysqli_query($conexion, $sql1);

if($Des==""||$exis==""){
 echo "vacio";
}else{
        if(letras($exis)||is_numeric($exis) && strpos($exis, '.') !== false){

            echo"letras";

        }else{
            if ((mysqli_num_rows($resul) > 0)) {
                // El usuario ya está registrado en la base de datos.
              
                echo"Registrado";
                
            }else{
                $sql="INSERT INTO equipo_epp(Des_epp, Can_EPP, CanG_EPP) Values ('$Des','$exis','$exis') ";
            $rta= mysqli_query($conexion,$sql); 
            if(!$rta){
                echo "No se insertro los datos";
            }else{
                echo "exito";
            }
            
            }
        }
    
   
}




?>
