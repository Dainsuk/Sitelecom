<?php
$id = $_GET['id'];

$cnx = mysqli_connect("localhost", "root", "root123456", "dbprueba");
$sql = "DELETE FROM talumno WHERE id = '$id'";
$rta = mysqli_query($cnx, $sql);
header("Location: index.php");
?>