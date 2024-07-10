
<?php
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
    header("location:../../index.php");
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sitelecom-SGA</title>
    <link rel="icon" href="../../logo1.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../font/bootstrap-icons.css">
    <link rel="stylesheet" href="estilo_regispro.css">
    <link rel="stylesheet" href="estilosform.css">
    <link rel="stylesheet" href="home.css">
   

</head>

<body>
 

        
        <div class="header__superior">
            <div class="t">
            <a href="../../home/principal.php"><i class="bi bi-arrow-left-circle"></i></a>
            </div>
      
            <div class="logo">

       
                <img src="../../descargar.jpg" alt="">
            </div>

        </div>
        <div class="container__menu">
            <nav>
            
                <ul>
                    
                    <li><a href="../herramienta/reproducto.php">Herramienta</a></li>
                    <li><a href="#">EPP</a></li>
                    <li><a href="../miscelaneo/reproducto.php">Miscelaneo</a></li>
                </ul>
            </nav>
        </div><br>
      

<div class="container">
        <h2 align="center">Equipo EPP</h2>
        <form  id="guardar-form">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="Des" name="Des" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="text" id="exis" name="exis" required>
            </div>
            <button type="button" onclick="validarR()" class="btn-save">Guardar</button>
        </form>
    </div>
    <br><br>
    <div align="left">
    <?php
    include 'formulario.php';
        ?>
        <div>
            <br><br>
        <div>
  

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="mensaje.js"></script>
<script src="../../bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php

}
?>
