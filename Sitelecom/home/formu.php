<?php
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
    header("location:../index.php");
}else{
    ?>


<!DOCTYPE html>
<html>
<head>
<?php
// Conexión a la base de datos (ajusta los valores de acuerdo a tu configuración)
 include '../conexion1.php';
$proyecto=$_GET["proyecto"];
$escenario=$_GET["escenario"];
$encargado=$_GET["encargado"];

?>
    <title>Asignación de Elementos a Brigada</title>
    <link rel="stylesheet" href="estilosform.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<br>
<div class="site">
<img src="../descargar.jpg"; >
</div>
<form class="brigada" method="POST" action="editare1.php" onsubmit="return validarForm()">
<div class="dos">
<h3>Datos Actuales del Encargado</h3>
</div>
        <div class="form-group">    
            <label for="cantidad">Encargado</label>
            <input type="text" class="" name="encargado" value="<?=$encargado?>"  readonly >
        </div>
        <div class="form-group">
            <label for="proyecto">Proyecto:</label>
            <input type="text" id="proyectoInput" name="proyecto" value="<?=$proyecto?>" readonly >
        </div>
        <div class="form-group">
            <label for="cantidad">Escenario</label>
            <input type="text" class="" name="escenario" value="<?=$escenario?>" readonly >
        </div>
    
        <div class="border"></div>
        
    <div class="uno">
    <h3>Actualizacion de Proyecto y Escenario</h3>
    <select id="proyectoSelect" name="proyecto1">
        <option value="0">Selecciona un Proyecto</option>
        <?php
        // Consulta para obtener la lista de proyectos
        $proyectos = $conexion->query("SELECT id, nombre FROM proyectos")->fetchAll(PDO::FETCH_ASSOC);

        foreach ($proyectos as $proyecto) {
            echo "<option value='{$proyecto['id']}'>{$proyecto['nombre']}</option>";
        }
        ?>
    </select><br>

    <br>

 
    <select id="escenario" name="escenario1">
        <option value="0">Selecciona un Proyecto primero</option>
    </select><br>
    <div class="border"></div>
    <button type="submit" style="background-color: #007bff;color: #fff; width: 30%;border: none; padding: 5px 20px; border-radius: 3px;">Actualizar</button>
    <button type="button" onclick="window.location.href='mostrar.php'" style="background-color: red;color: #fff; width: 30%;border: none; padding: 5px 20px; border-radius: 3px;">Cancelar</button>

    </div>
    
    
</form>

<script>
    $("#proyectoSelect").change(function () {
        var proyectoSeleccionado = $(this).val();
        var escenarioSelect = $("#escenario");

        escenarioSelect.empty();
        escenarioSelect.append('<option value="0">Cargando escenarios...</option>');

        if (proyectoSeleccionado > 0) {
            $.ajax({
                type: "POST",
                url: "h.php", // Cambia el nombre del archivo según tu configuración
                data: { proyecto_id: proyectoSeleccionado },
                dataType: "json",
                success: function (data) {
                    escenarioSelect.empty();
                    escenarioSelect.append('<option value="0">Selecciona un Escenario</option>');
                    $.each(data, function (index, escenario) {
                        escenarioSelect.append('<option value="' + escenario.id + '">' + escenario.nombre + '</option>');
                    });
                }
            });
        }
    });

    function validarForm() {
        const form = document.querySelector('form');
        const formData = new FormData(form);

        fetch('editare1.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data === "vacio") {
                Swal.fire({
                    icon: 'info',
                    text: 'Por favor Complete los campos de proyecto y escenario',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
            } else if (data === "campos vacios") {
                Swal.fire({
                    icon: 'info',
                    text: 'Por favor, complete todos los campos obligatorios',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
            } else if (data === "asignado") {
                Swal.fire({
                    icon: 'warning',
                    text: 'El encargado ya tiene asignados elementos. No se puede asignar nuevamente.',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
            } else if (data === "no_epp") {
                Swal.fire({
                    icon: 'warning',
                    text: 'No hay suficientes elementos de EPP disponibles.',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
            } else if (data === "no_herra") {
                Swal.fire({
                    icon: 'warning',
                    text: 'No hay suficientes herramientas disponibles.',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });} else if (data === "no_misce") {
                Swal.fire({
                    icon: 'warning',
                    text: 'No hay suficientes elementos misceláneos disponibles.',
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
                            window.location.href = '../home/mostrar.php';
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
