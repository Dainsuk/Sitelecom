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
   
    <link rel="stylesheet" href="estilo_regispro.css">
    <link rel="stylesheet" href="estilosform.css">

</head>

<body>
<?php
$id=$_GET["id"];
$des=$_GET["des"];
$can=$_GET["can"];
?>
<body>


<div class="header__superior">
    <div class="logo">
        <img src="../../descargar.jpg">
    </div>
</div>
<div class="container">

        <h2 align="center">Equipo EPP</h2>
        <form action="editare1.php" method="POST" id="guardar-form" onsubmit="return validarForm()">
        <div class="form-group">
                <label for="nombre">ID:</label>
                <input type="text" class="" name="id" value="<?=$id?>" readonly >
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="Des" value="<?=$des?>" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="text" class="" name="exis" value="<?=$can?>" readonly  >
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad a sumar:</label>
                <input type="text" class="" name="exis1" value="">
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
            if (data === "desN") {
                Swal.fire({
                    icon: 'info',
                    text: 'La descripcion no es valida',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
            } else if (data === "CanN") {
                Swal.fire({
                    icon: 'info',
                    text: 'La cantidad ingresada no es valida',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
            } else if (data === "existe R") {
                Swal.fire({
                    icon: 'warning',
                    text: 'Este registro ya existe',
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
                            window.location.href = 'reproducto.php';
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
