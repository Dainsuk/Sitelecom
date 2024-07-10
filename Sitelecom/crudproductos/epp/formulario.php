<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="buscador.css">
    <title>Document</title>
</head>
<body>
<div  align="center">
        <form class="buscar" action="buscar.php" method="post">
            <input class="boton1" type="text" name="nombre" id="" placeholder="Buscar" required>
            <button class="boton" type="submit" value=""><i class="bi bi-search"></i></button>
            
      

        </form>
       
    </div><br><br>
    <div align="center">
    <?php
        include 'mostrar.php';
    ?>
    </div>
    
</body>
</html>