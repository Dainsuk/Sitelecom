<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarpro</title>
    <link rel="stylesheet" href="estilo_regispro.css">

</head>

<body>
    <div>
        <form action="buscar.php" method="post">
            <input type="text" name="buscar" id="">
            <imput type="submit" value="buscar"></imput>
            <a href="nuevo.php">nuevo</a>

        </form>
    </div>

    <header>
        <div class="header__superior">
            <div class="inicio">
            <a href
            ="menuprincipalprueba2.html"><img src="inicio.jpg" alt="" ></a>
            </div>
            <div class="logo">
                <img src="descargar.jpg" alt="">
            </div>
            <div class="title-container">
                <h1>REGISTRO DE PRODUCTO</h1>
            </div>
        </div>
        <div class="container__menu">
            <nav>
                <ul>
                    <li><a href="#">EPP</a></li>
                    <li><a href="#">HERRAMIENTA</a></li>
                    <li><a href="#">MISCELANEO</a></li>
                </ul>
            </nav>
        </div>
        <br>
        <div class="title-txt1">
            <h1>Descripcion</h1>
            <br>
            <textarea rows="5" cols="50" style="resize: both;"></textarea>
            </br>
        </div>
        <div class="title-txt">
            <h1>Existencias</h1>
            <br>
            <input type="text">
            </br>
        </div>
        <div class="containerbtn">
            <a class="btn-a"href="#">Insertar</a>
            <a class="btn-a"href="#">Modificar</a>
            <a class="btn-a"href="#">Eliminar</a>
        </div>
        <div class="bottom-row">
            <a href="#" class="btn-a">Dar de alta</a>
            <a href="#" class="btn-a">Dar de baja</a>
        </div>
     <div>
        <br><br><br><br>
      <?php
        include '../crud/formulario.php';
        ?>
        </div>
     
  

    </header>
   

</body>
</body>
</html>