<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
    header("location:../index.php");
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sitelecom-SGA</title>
    <link rel="icon" href="../logo1.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tabla.css">
 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../font/bootstrap-icons.css">
 
</head>
<body>

<div  class="container">
<div class="t">
    <a href="index.php"><i class="bi bi-arrow-left-circle"></i></a>
</div>
            
<div>
    <img src="../descargar.jpg" >
</div>
 
    <div class="border"></div>
    <div>
    <?php
    include 't.php';
    ?>
    </div>
   
    <div class="border"></div>
    <h2>Tabla de Proyectos Actuales </h2>

<?php
        include '../conexion.php';
        
        $query1 = "SELECT proyecto_id, proyecto_nombre, escenario_id ,escenario_nombre FROM vistape";
        $result1 = $conexion->query($query1);
     
        echo "<div id=main-container><table border=1 align=center>";
        echo "<thead><tr><th color:#f8681b;>ID</th><th>Proyecto</th><th>Escenarios</thead>";
            
            while ($row = $result1->fetch_assoc()) {
                echo "<tr>
                <td>" . $row["proyecto_id"]. "</td>
                <td>" . $row["proyecto_nombre"] . "</td>
                <td>" . $row["escenario_nombre"] . "</td>
                
                
               
                </tr>";
            }
          
            
            echo "</table></div>";
        ?>
        </div>
</body>
</html>
<?php

}
?>


