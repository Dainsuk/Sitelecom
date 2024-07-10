<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
    header("location:../index.php");
}else{
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <title>Sitelecom-SGA</title>
    <link rel="icon" href="../logo1.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../font/bootstrap-icons.css">
        <title>menuprincipal</title>
        <link rel="stylesheet" href="estilo_menu2.css">
    </head>
    <body>
        <header>
            <div class="header__superior">
                <div class="logo">
                    
                    <img src="descargar.jpg" >
                </div>
                <div class="botonCS">
                     <!--
                    <a href="http://"</a> 
                    -->
                
                    <label for="cerrarSesion"><?php echo "<label>Bienvenido <a href='../home/AdminUsuario/adminUsuarios.php'><i class=' bi-person-circle'></i></a></label>";                                
                    
                    echo $usuario['Nombre']; ?> </label>
                    <form method="post">
                        <button type="button" onclick="window.location.href='salir.php'">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
    
            <div class="container__menu">
                <nav>
                    <ul>
                        <li><a href="../proyectos/index.php">Proyecto</a></li>
                        <li><a href="../crudproductos/epp/reproducto.php">Registrar producto</a></li>
                        <li><a href="mostrar.php">Lideres</a></li>
                    </ul>
                </nav>
            </div><br>
            <h1> ALMACEN GENERAL-SITELECOM</h1>
            <?php
                include "tabla.php";
            ?>
        </header>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     
    </body>
    </html>
    <?php
}



?>
