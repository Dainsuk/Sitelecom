<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<center>
<br>
    <div>
        <form action="buscar.php" method="post">
            <input type="text" name="buscar" id="">
            <input type="submit" value="Buscar">
            <a href="nuevo.php">Añadir Nuevo</a>
        </form>
    </div>
    <br>
    <div>
        <table border="1">
            <tr>
                <td>ID</td>
                <td>NOMBRES</td>
                <td>APELLIDOS</td>
                <td>NOTA1</td>
                <td>NOTA2</td>
                <td>NOTA3</td>
                <td>PROMEDIO</td>
                <td>ESTADO</td>
            </tr>
            <?php
                $cnx = mysqli_connect("localhost", "root", "root123456", "dbprueba");
                $sql = "SELECT id, nom, ape, n1, n2, n3, ROUND((n1+n2+n3)/3, 1) as p
                        FROM talumno
                        
                        order by p desc";
                $rta = mysqli_query($cnx, $sql);
                while ($mostrar = mysqli_fetch_row($rta)) {
                    ?>
                    <tr>
                        <td><?php echo $mostrar[0] ?></td>
                        <td><?php echo $mostrar[1] ?></td>
                        <td><?php echo $mostrar[2] ?></td>
                        <td><?php echo $mostrar[3] ?></td>
                        <td><?php echo $mostrar[4] ?></td>
                        <td><?php echo $mostrar[5] ?></td>
                        <td><?php echo $mostrar[6] ?></td>
                        <td>
                            <?php 
                                if ($mostrar[6] >= 13) {
                                    echo "Aprobado";
                                }
                                else {
                                    echo "Desaprobado";
                                }
                            ?>
                        
                        </td>
                        <td>
                            <a href="editar.php?
                            id=<?php echo $mostrar[0] ?> &
                            nom=<?php echo $mostrar[1] ?> &
                            ape=<?php echo $mostrar[2] ?> &
                            n1=<?php echo $mostrar[3] ?> &
                            n2=<?php echo $mostrar[4] ?> &
                            n3=<?php echo $mostrar[5] ?>
                            ">Editar</a>
                            <a href="speliminar.php? id=<?php echo $mostrar[0] ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
        </table>
    </div>
    </center>
</body>
</html>