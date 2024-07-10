<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tabla2.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
    <br><br>
    <div class="container">
    <div class="t">
    <a href="reproducto.php"><i class="bi bi-arrow-left-circle"></i></a>
</div>
            
<div>
    <img src="../../descargar.jpg" >
</div>

    <div class="border"></div>
    <h2>Resultados de la busqueda</h2>
<?php
         include "../../conexion.php";
         $nombre=$_POST["nombre"];
        
        $query1 = "SELECT * FROM Miscelaneo where Des_Misce LIKE'%$nombre%' ";
        $result1 = $conexion->query($query1);

        if($result1 && mysqli_num_rows($result1) > 0){
     
        echo "<div id=main-container><table class=new border=1 align=center>";
        echo "<thead><tr><th color:#f8681b;>ID</th><th>Herramienta</th><th>Existencias de Herramienta</th><th></th><th></th><th></th><th></th></tr></thead>";
                 
            while ($row = $result1->fetch_assoc()) {
                echo "<tr>
                <td>" . $row["id_Misce"]. "</td>
                <td>" . $row["Des_Misce"] . "</td>
                <td>" . $row["Can_Misce"] . "</td>
                <td>" . "<a href=editare.php?id=".$row["id_Misce"]."&des=".$desEPPEncoded = urlencode($row["Des_Misce"])."&can=".$row["Can_Misce"]."><div class='edt'><i class='bi bi-pencil-square'></i></div></a>"."</td>
                <td>" . "<a href='#' onclick='confirmDelete(" . $row['id_Misce'] . ")'><div class='e'><i class='bi bi-trash3-fill'></i></div></a>" . "</td>
                <td>" . "<a href=darbaja.php?id=".$row["id_Misce"]."&can=".$row["Can_Misce"]."><div class='baja'><i class='bi bi-clipboard-minus'></i></div></a>" . "</td>
                <td>" . "<a href=daralta.php?id=".$row["id_Misce"]."&can=".$row["Can_Misce"]."><div class='alta'><i class='bi bi-clipboard-plus'></i></div></a>" . "</td>
               
               
                </tr>";
            }
          
            
            echo "</table>";
        }else{
                echo"<script>
               
                Swal.fire({
                    text:'No se encontraron resultados de busqueda',
                    icon: 'info',
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
          <script>
function confirmDelete(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirige a la página de eliminación si se confirma
            window.location.href = 'eliminare.php?id=' + id;
        }
    });
}
</script>
</div>
</body>
</html>
