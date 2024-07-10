<?php
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
   
    <link rel="stylesheet" href="estilo_regispro.css">
    <link rel="stylesheet" href="estilosform.css">

</head>

<body>
<?php

$proyecto=$_GET["proyecto"];
$escenario=$_GET["escenario"];
$encargado=$_GET["encargado"];
?>
<body>


<div class="header__superior">
    <div class="logo">
        <img src="../descargar.jpg">
    </div>
</div>
<div class="container">

        <h3 align="center">Cambio de Proyecto y Escenario</h3>
        <form action="editare1.php" method="POST" id="guardar-form" ">
        <div class="form-group">
            </div>
            <div class="form-group">
                <label for="cantidad">Encargado</label>
                <input type="text" class="" name="encargado" value="<?=$encargado?>" required >
            </div>
            <div class="form-group">
                <label for="nombre">Proyecto:</label>
                <input type="text" id="proyecto" name="proyecto" value="<?=$proyecto?>" required>
            </div>
            <div class="form-group">
                <label for="cantidad">escenario</label>
                <input type="text" class="" name="escenario" value="<?=$escenario?>" required >
            </div>
           
            <div align="center">
            <button type="submit" class="btn-save">Guardar</button>
            <button type="button" onclick="window.location.href='reproducto.php'" class="btn-saves">Cancelar</button>

            </div>
        </form>
    </div>
    <br><br>
    
    <div>

    </div>

   


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script >
function validarForm() {
        const proyectoInput = document.getElementById("proyecto");
        const form = document.querySelector('form');
        const formData = new FormData(form);

        fetch('editare1.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data === "Ya existe un registro con un nombre similar. No se puede actualizar.") {
                Swal.fire({
                    icon: 'info',
                    text: 'Ya existe un registro con un nombre similar. No se puede actualizar.',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
            } else if (data === "No se actualizó.") {
                Swal.fire({
                    icon: 'info',
                    text: 'No se actualizó.',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
            } else if (data === "No se encontró el registro.") {
                Swal.fire({
                    icon: 'warning',
                    text: 'No se encontró el registro.',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
            } else if (data === "El campo de escenarios no puede quedar vacío") {
                Swal.fire({
                    icon: 'warning',
                    text: 'El campo de escenarios no puede quedar vacío',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
            }else if (data === "exito") {
                Swal.fire({
                    icon: 'success',
                    text: 'Actualizacion Exitosa',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                })
                        .then(() => {
                            window.location.href = '../crudproductos/epp/reproducto.php';
                        });
                
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'Error al guardar los cambios',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
            }
        });

        return false;
    }
</script>

</body>
</html>
<?php
}
?>
