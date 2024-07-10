<?php
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
    <link rel="stylesheet" href="mostrar.css">
 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../font/bootstrap-icons.css">
   
</head>
<body>

<div  class="container">
<div class="t">
    <a href="mostrar.php"><i class="bi bi-arrow-left-circle"></i></a>
</div>
<button class="hist" onclick="window.location.href='../PDF/index.php'">Imprimir</button>
<div>
    <img src="../descargar.jpg" >
</div>
 
    <div class="border"></div>
   
    <h2>Historial de Brigadas </h2>

<?php
      
      include "../conexion.php";
        
        
        $query1 = "SELECT * FROM reportlideres";
        $result1 = $conexion->query($query1);
     
        echo "<div id=main-container><table border=1 align=center>";
        echo "<thead><tr><th color:#f8681b;>Proyecto</th><th>Escenario</th><th>Encargado</th><th>Salida</th><th>Regreso</th></thead>";
            
            while ($row = $result1->fetch_assoc()) {
                echo "<tr>
                <td>" . $row["proyecto"]. "</td>
                <td>" . $row["escenario"] . "</td>
                <td>" . $row["encargado"] . "</td>
                <td>" . $row["salida"]. "</td>
                <td>" . $row["regreso"]. "</td>
              
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
