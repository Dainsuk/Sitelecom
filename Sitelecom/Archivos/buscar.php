<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="buscar.php" method="post">
            <input type="text" name="buscar" id="">
            <input type="submit" value="Buscar">
            <a href="nuevo.php">Añadir Nuevo</a>
        </form>
    </div>
    <div>
        <table>
            <tr>
                <td>ID</td>
                <td>NOMBRES</td>
                <td>APELLIDOS</td>
                <td>NOTA1</td>
                <td>NOta2</td>
                <td>NOTA3</td>
                <td>PROMEDIO</td>
            </tr>
            <?php
                $buscar = $_POST['buscar'];
                $cnx = mysqli_connect("localhost", "root", "root123456", "dbprueba");
                $sql = "SELECT id, nom, ape, n1, n2, n3, (n1+n2+n3)  FROM talumno WHERE nom like '$buscar' '%' order by id desc";
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
</body>
</html>