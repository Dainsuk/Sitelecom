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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="index.css">

    <link rel="stylesheet" href="estilo_menu2.css">
</head>
<body>
<header>
        <div class="header__superior">
        <div class="t">
            <a href="../home/principal.php"><i class="bi bi-arrow-left-circle"></i></a>
            
           
            </div>
            <div class="imagen">
                
            <img src="../descargar.jpg"> 
            </div>
        </div>
        <div class="container__menu">
            <nav>
                <ul>
                    <li><a href="mostrar.php"> Proyectos y Escenarios</a></li>
                    <li><a href="../formulario/formu.php">Asignacion de material</a></li>
                    <li><a href="../formulario/regresar.php">Entrega de material</a></li>

                </ul>
            </nav>
        </div><br>

    <div class="grid">
    <form class="form" method="POST" action="index.php" >
    <h1>Registro de Proyecto </h1><br>
        <label style=" " for="proyecto">Nombre del  Proyecto</label><br>
        <input type="text" type="text" id="proyecto" name="proyecto" >
        <div class="border"></div>
        
       
        <br>
        <div  id="escenariosContainer">
            <!-- Aquí se agregarán los campos de escenarios dinámicamente -->
        </div><br><br>
        <div class="botones">
        <button type="button"  id="agregarEscenario" >Agregar Escenario</button>
        <button type="submit" >Guardar</button>
        </div>
    </form>
</div>

    <script>
        let escenarioCount = 0;

        document.getElementById('agregarEscenario').addEventListener('click', function () {
            escenarioCount++;

            const escenarioDiv = document.createElement('div');
            escenarioDiv.innerHTML = `
                <label for="escenario_${escenarioCount}">Escenario:</label>
                <input type="text"  style="width: 45%; height: 30px;" id="escenario_${escenarioCount}" name="escenarios[]">
                <button type="button" style="width: 10%; height: 30px;" class="quitarEscenario"><i class="bi bi-x-lg"></i></button>
            `;

            escenarioDiv.querySelector('.quitarEscenario').addEventListener('click', function () {
                escenarioDiv.remove();
            });

            document.getElementById('escenariosContainer').appendChild(escenarioDiv);

            // Habilitar o deshabilitar el botón "Quitar Escenario" según la cantidad deseada
            const cantidadEscenariosDeseada = parseInt(document.getElementById('cantidad_escenarios').value);
            if (escenarioCount >= cantidadEscenariosDeseada) {
                document.getElementById('agregarEscenario').disabled = true;
            } else {
                document.getElementById('agregarEscenario').disabled = false;
            }
        });
    </script>
    </header>


    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   include '../conexion.php';

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    $proyecto = trim($_POST['proyecto']);
    $escenarios = isset($_POST['escenarios']) ? $_POST['escenarios'] : array(); // Verifica si 'escenarios' está definido

    if (empty($escenarios) || (count(array_filter($escenarios)) === 0)) {
        // Muestra un mensaje indicando que al menos un escenario debe ser ingresado.
        echo "<script>
            // Código JavaScript para mostrar una alerta SweetAlert2
            Swal.fire({
                icon: 'info',
                text: 'Debe ingresar al menos un escenario',
                timer: 5000,
                timerProgressBar: false, 
                showConfirmButton: false,
            });
        </script>";
    } else {

    // Validar que el campo de proyecto no esté vacío
    if (empty($proyecto)) {
        echo "<script>
        // Código JavaScript para mostrar una alerta SweetAlert2
        Swal.fire({
            icon:'info',
            text: 'no se ha asignado un proyecto',
            timer: 5000,
            timerProgressBar: false, 
            showConfirmButton: false,
            
        });
      </script>";
    } else {
        // Verificar si al menos un escenario está presente
        $escenarioPresente = false;
        foreach ($escenarios as $escenario) {
            if (!empty($escenario)) {
                $escenarioPresente = true;
                break;
            }
        }

        if (!$escenarioPresente) {
             echo "<script>
            // Código JavaScript para mostrar una alerta SweetAlert2
            Swal.fire({
                icon:'info',
                text: 'debe ingresar almenos un escenario',
               timer: 5000,
                timerProgressBar: false, 
                showConfirmButton: false,
                
            });
          </script>";
        } else {
            // Verificar si el proyecto ya existe en la base de datos
            $proyectoExistente = false;
            $query = "SELECT id FROM proyectos WHERE nombre = '$proyecto'";
            $result = $conexion->query($query);

            if ($result->num_rows > 0) {
                $proyectoExistente = true;
                echo "<script>
            // Código JavaScript para mostrar una alerta SweetAlert2
            Swal.fire({
                icon:'info',
                text: 'El proyecto ya esta registrado',
                timer: 5000,
                timerProgressBar: false, 
                showConfirmButton: false,
                
            });
          </script>";
            }

            if (!$proyectoExistente) {
                // Insertar el proyecto en la tabla proyectos
                $sql = "INSERT INTO proyectos (nombre) VALUES ('$proyecto')";
                $conexion->query($sql);

                $proyecto_id = $conexion->insert_id;

                // Insertar los escenarios en la tabla escenarios
                foreach ($escenarios as $escenario) {
                    if (!empty($escenario)) {
                        $sql = "INSERT INTO escenarios (nombre, proyecto_id) VALUES ('$escenario', $proyecto_id)";
                        $conexion->query($sql);
                    }
                }

                echo "<script>
            // Código JavaScript para mostrar una alerta SweetAlert2
            Swal.fire({
                icon:'success',
                text: 'Proyecto Registrado',
                timer: 5000,
                timerProgressBar: false, 
                showConfirmButton: false,
                
            });
          </script>";
            }
        }
    }

    $conexion->close();
}
}

?>

</body>
</html>

<?php
}
?>

