<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tabla.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Document</title>
</head>
<body>
<?php
        include "../../conexion.php";
       
        
        $query1 = "SELECT id_Herramienta, Des_Herra, Can_Herra, CanG_Herra FROM herramienta";
        $result1 = $conexion->query($query1);
     
        echo "<div id=main-container><table border=1 align=center>";
        echo "<thead><tr><th color:#f8681b;>ID</th><th>Herramienta</th><th>Existencias de Herramienta</th><th></th><th></th><th></th><th></th></tr></thead>";
            
            while ($row = $result1->fetch_assoc()) {
                echo "<tr>
                <td>" . $row["id_Herramienta"]. "</td>
                <td>" . $row["Des_Herra"] . "</td>
                <td>" . $row["CanG_Herra"] . "</td>
                <td>" . "<a href=editare.php?id=".$row["id_Herramienta"]."&des=".$desEPPEncoded = urlencode($row["Des_Herra"])."&can=".$row["CanG_Herra"]."><div class='edt'><i class='bi bi-pencil-square'></i></div></a>"."</td>
                <td>" . "<a href='#' onclick='confirmDelete(" . $row['id_Herramienta'] . ")'><div class='e'><i class='bi bi-trash3-fill'></i></div></a>" . "</td>
                <td>" . "<a href=darbaja.php?id=".$row["id_Herramienta"]."&can=".$row["Can_Herra"]."><div class='baja'><i class='bi bi-clipboard-minus'></i></div></a>" . "</td>
                <td>" . "<a href=daralta.php?id=".$row["id_Herramienta"]."&can=".$row["Can_Herra"]."><div class='alta'><i class='bi bi-clipboard-plus'></i></div></a>" . "</td>
               
                </tr></div>";
            }
          
            
            echo "</table>";
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
</body>
</html>

