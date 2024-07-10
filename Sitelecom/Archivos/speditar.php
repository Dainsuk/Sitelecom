<?php
$id = $_POST['id'];
$nom = $_POST['nom'];
$ape = $_POST['ape'];
$n1 = $_POST['n1'];
$n2 = $_POST['n2'];
$n3 = $_POST['n3'];
$cnx = mysqli_connect("localhost", "root", "root123456", "dbprueba");
$sql = "UPDATE talumno set nom='$nom', ape='$ape', n1='$n1', n2='$n2', n3='$n3' WHERE id = '$id'";
$rta = mysqli_query($cnx, $sql);
header("Location: index.php");
?>