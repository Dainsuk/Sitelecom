<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$id = $_GET['id'];
$nom = $_GET['nom'];
$ape = $_GET['ape'];
$n1 = $_GET['n1'];
$n2 = $_GET['n2'];
$n3 = $_GET['n3'];
?>
    <div>
    <form action="speditar.php" method="post">
        <table>
            <tr>
                <td>Ingresar Datos:</td>
                <td><input type="text" name="id" style="visibility: hidden;"  value="<?=$id?>" id=""></td>
            </tr>
            <tr>
                <td>NOMBRES:</td>
                <td><input type="text" name="nom" value="<?=$nom?>" id="" ></td>
            </tr>
            <tr>
                <td>APELLIDOS:</td>
                <td><input type="text" name="ape" value="<?=$ape?>" id=""></td>
            </tr>
            <tr>
                <td>NOTA1:</td>
                <td><input type="text" name="n1" value="<?=$n1?>" id=""></td>
            </tr>
            <tr>
                <td>NOTA2":</td>
                <td><input type="text" name="n2" value="<?=$n2?>" id=""></td>
            </tr>
            <tr>
                <td>NOTA3:</td>
                <td><input type="text" name="n3" value="<?=$n3?>" id=""></td>
            </tr>
            <tr>
                <td><input type="submit" value="Actualizar"></td>
            </tr>
        </table>

    </form>

    </div>
</body>
</html>