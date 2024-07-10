<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Document</title>
</head>
<body>
<?php
$id = $_GET['id'];
include '../../conexion.php';
$sql = "DELETE FROM equipo_EPP WHERE id_EPP = $id";
$rta = mysqli_query($conexion, $sql);

if (!$rta) {
    echo "No se eliminó";
} else {
    // redirige de vuelta a la página principal
    header("location:reproducto.php");
}
?>
</body>
</html>
