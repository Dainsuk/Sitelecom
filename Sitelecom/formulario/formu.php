<?php
// Inicia la sesión y verifica si la variable de sesión 'username' está configurada
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
session_start();
$usuario = $_SESSION['username'];

if (!isset($usuario)) {
    header("location:../index.php");
    exit();
}

// Conexión a la base de datos
try {
    include '../conexion1.php';

    // Recuperar elementos de la base de datos
    $eppElementos = $conexion->query("SELECT id_EPP, Des_EPP, Can_EPP FROM equipo_epp")->fetchAll(PDO::FETCH_ASSOC);
    $herramientaElementos = $conexion->query("SELECT id_Herramienta, Des_Herra, Can_Herra FROM herramienta")->fetchAll(PDO::FETCH_ASSOC);
    $miscelaneoElementos = $conexion->query("SELECT id_Misce, Des_Misce, Can_Misce FROM miscelaneo")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sitelecom-SGA</title>
    <link rel="icon" href="../logo1.png">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form class="brigada" method="POST" action="asignar.php" onsubmit="return validarForm()">
        <div class="t">
            <a href="../Proyectos/index.php"><i class="bi bi-arrow-left-circle"></i></a>
        </div>

        <div>
            <img src="../descargar.jpg">
        </div>
        <div class="border"></div>

        <br>
        <label for="proyecto">Seleccionar Proyecto:</label>
        <select id="proyecto" name="proyecto">
            <option value="0">Selecciona un Proyecto</option>
            <?php
            // Obtener y mostrar los proyectos
            $proyectos = $conexion->query("SELECT id, nombre FROM proyectos")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($proyectos as $proyecto) {
                echo "<option value='{$proyecto['id']}'>{$proyecto['nombre']}</option>";
            }
            ?>
        </select><br>

        <br>
        <label for="escenario">Seleccionar Escenario:</label>
        <select id="escenario" name="escenario">
            <option value="0">Selecciona un Proyecto primero</option>
        </select><br><br>

        <label for="encargado">Encargado de Brigada:</label>
        <input type="text" name="encargado" id="encargado">
        <br>
        <div class="border"></div>
        <div class="general">
            <h2>Asignación de EPP</h2>
            <?php
            // Mostrar elementos EPP
            foreach ($eppElementos as $epp) {
                echo "<label for='epp_{$epp['id_EPP']}'>{$epp['Des_EPP']} (Disponibles: {$epp['Can_EPP']})</label>";
                echo "<input class='epp' type='text' name='epp_{$epp['id_EPP']}' id='epp_{$epp['id_EPP']}' oninput='validarCantidad(\"epp_{$epp['id_EPP']}\", {$epp['Can_EPP']})'><br>";
                echo "<span id='epp_{$epp['id_EPP']}-error'></span><br>";
            } 
            ?>

            <br>
            <div class="border"></div>

            <h2>Asignación de Herramienta</h2>
            <?php
            // Mostrar elementos Herramienta
            foreach ($herramientaElementos as $herra) {
                echo "<label for='herra_{$herra['id_Herramienta']}'>{$herra['Des_Herra']} (Disponibles: {$herra['Can_Herra']})</label>";
                echo "<input type='text' name='herra_{$herra['id_Herramienta']}' id='herra_{$herra['id_Herramienta']}' oninput='validarCantidad(\"herra_{$herra['id_Herramienta']}\", {$herra['Can_Herra']})'><br>";
                echo "<span id='herra_{$herra['id_Herramienta']}-error'></span><br>";
            }
            ?>

            <br>
            <div class="border"></div>

            <h2>Asignación de Miscelaneo</h2>
            <?php
            // Mostrar elementos Miscelaneo
            foreach ($miscelaneoElementos as $misce) {
                echo "<label for='misce_{$misce['id_Misce']}'>{$misce['Des_Misce']} (Disponibles: {$misce['Can_Misce']})</label>";
                echo "<input type='text' name='misce_{$misce['id_Misce']}' id='misce_{$misce['id_Misce']}' oninput='validarCantidad(\"misce_{$misce['id_Misce']}\", {$misce['Can_Misce']})'><br>";
                echo "<span id='misce_{$misce['id_Misce']}-error'></span><br>";
            }
            ?>

            <br>
            <div class="border"></div>
            <button type="submit" style="background-color: #007bff;color: #fff; width: 80px;border: none; padding: 5px 20px; border-radius: 3px;">Asignar</button>
        </div>
    </form>

    <script>
        $("#proyecto").change(function () {
            var proyectoSeleccionado = $(this).val();
            var escenarioSelect = $("#escenario");

            escenarioSelect.empty();
            escenarioSelect.append('<option value="0">Cargando escenarios...</option>');

            if (proyectoSeleccionado > 0) {
                $.ajax({
                    type: "POST",
                    url: "h.php",
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

            fetch('asignar.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                let message = '';
                let icon = '';

                switch (data) {
                    case "campos vacios":
                        message = 'Por favor, complete todos los campos obligatorios';
                        icon = 'info';
                        break;
                    case "asignado":
                        message = 'El encargado ya tiene asignados elementos. No se puede asignar nuevamente';
                        icon = 'warning';
                        break;
                    case "no_epp":
                        message = 'No hay suficientes elementos de EPP disponibles.';
                        icon = 'warning';
                        break;
                    case "negativo":
                        message = 'No se permiten cantidades negativas';
                        icon = 'info';
                        break;
                    case "no_herra":
                        message = 'No hay suficientes elementos de herramienta disponibles.';
                        icon = 'warning';
                        break;
                    case "no_misce":
                        message = 'No hay suficientes elementos misceláneos disponibles.';
                        icon = 'warning';
                        break;
                    case "Asignación Exitosa":
                        message = 'Actualización Exitosa';
                        icon = 'success';
                        break;
                    default:
                        message = 'Error al guardar los cambios';
                        icon = 'error';
                }

                Swal.fire({
                    icon: icon,
                    text: message,
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                }).then(() => {
                    if (data === "Asignación Exitosa") {
                        window.location.href = '../home/mostrar.php';
                    }
                });
            });
            return false;
        }
    </script>
</body>
</html>
