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
<html>
<head>
<title>Sitelecom-SGA</title>
    <link rel="icon" href="../logo1.png">
    <link rel="stylesheet" href="t1.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../font/bootstrap-icons.css">
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['proyecto_id'])) {
    $proyecto_id = $_POST['proyecto_id'];

    // Conecta a la base de datos y obtiene el nombre del proyecto seleccionado
    include '../conexion.php';
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    $sql = "SELECT nombre FROM proyectos WHERE id = $proyecto_id";
    $result = $conexion->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $nombre_proyecto = $row['nombre'];
    } else {
        die("Proyecto no encontrado.");
    }

    // Obtén los escenarios relacionados con el proyecto
    $sql = "SELECT id, nombre FROM escenarios WHERE proyecto_id = $proyecto_id";
    $result = $conexion->query($sql);

    $escenarios = [];
    while ($row = $result->fetch_assoc()) {
        $escenarios[] = $row;
    }

    $conexion->close();
}
?>
<title>Sitelecom-SGA</title>
    <link rel="icon" href="../logo1.png">
</head>
<body>
<div class="Edit">
    <div class="t2">
        <a href="mostrar.php"><i class="bi bi-arrow-left-circle"></i></a>
    </div>
    <div>
        <img src="../descargar.jpg">
    </div>

    <form method="post" action="t2.php" onsubmit="return validarForm()">
        <input type="hidden" id="proyecto_id" name="proyecto_id" value="<?php echo $proyecto_id; ?>">
        <div class="border"></div>
        <h1>Proyecto</h1>
        <label for="proyecto">Nombre del Proyecto:</label>
        <input type="text" id="proyecto" name="proyecto" value="<?php echo $nombre_proyecto; ?>">
        <div class="border"></div>
        <h2>Escenarios:</h2>
        <div id="escenariosContainer">
            <?php
            foreach ($escenarios as $escenario) {
                echo "<label for='escenario_{$escenario['id']}'>Nombre del Escenario:</label>";
                echo "<input type='text' id='escenario_{$escenario['id']}' name='escenarios[{$escenario['id']}]' value='{$escenario['nombre']}'>";
                echo "<br>";
                echo "<br>";
            }
            ?>
        </div>
        <div class="border"></div>
        <h2>Agregar Nuevos Escenarios:</h2>
        <div id="nuevosEscenariosContainer"></div>
        <button class="boton1" type="button" id="agregarNuevoEscenario">Agregar Escenario</button>
        <input class="boton1" type="submit" value="Guardar Cambios">
    </form>
</div>

<script>
    document.getElementById('agregarNuevoEscenario').addEventListener('click', function () {
        const nuevosEscenariosContainer = document.getElementById('nuevosEscenariosContainer');
        
        const nuevoInput = document.createElement('input');
        nuevoInput.type = 'text';
        nuevoInput.name = 'nuevosEscenarios[]';
        nuevoInput.placeholder = 'Nombre del Escenario';
        
        const breakElement1 = document.createElement('br');
        const breakElement2 = document.createElement('br');
        
        nuevosEscenariosContainer.appendChild(nuevoInput);
        nuevosEscenariosContainer.appendChild(breakElement1);
        nuevosEscenariosContainer.appendChild(breakElement2);
    });

    function validarForm() {
        const proyectoInput = document.getElementById("proyecto");
        const form = document.querySelector('form');
        const formData = new FormData(form);

        fetch('t2.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data === "El nombre del proyecto no puede estar vacío") {
                Swal.fire({
                    icon: 'info',
                    text: 'Proyecto sin nombre',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
            } else if (data === "El nombre del proyecto ya está registrado") {
                Swal.fire({
                    icon: 'info',
                    text: 'El proyecto ya está registrado',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
            } else if (data === "El nombre del escenario ya está registrado en este proyecto") {
                Swal.fire({
                    icon: 'warning',
                    text: 'El nombre del escenario ya está registrado en este proyecto',
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
                            window.location.href = 'mostrar.php';
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

