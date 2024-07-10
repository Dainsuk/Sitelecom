<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
session_start();
$id_user = $_SESSION['id_user'];
$usuario = $_SESSION['username'];
$usuario1 = $_SESSION['Usu'];
//$ususu = $_SESSION['Usu'];
//$contrasenaa = $_SESSION['Contraseña'];
include "../../conexion.php";
$rty = $usuario1['Usu'];
$queryw = "SELECT Usu FROM admi WHERE Usu = '$rty'";
$resultw = $conexion->query($queryw);
$usuariounico = $resultw->fetch_assoc();

if (!isset($usuario)) {
    header("location:../../index.php");
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sitelecom-SGA</title>
        <link rel="icon" href="../../logo1.png">
        <link rel="stylesheet" type="text/css" href="../../registro/estilos.css">
        <link rel="stylesheet" href="../estilo_menu2.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="jquery-main.js"></script>
    </head>

    <body>

        <br>

        <img src="descargar.jpg" style='width: 35%;  margin-left:32%; height: 100px;'>
        <?php
        if ($usuariounico['Usu'] == 'Admin_Sitelecom') {
            ?>
            <div style="margin-left:30%;
                text-align:center;
                margin-right:30%;
                padding: 10px;
                border: 3px solid #ccc;
                border-radius: 3px;">
                <div class="t">
                    <a href="../../home/principal.php"><i class="bi bi-arrow-left-circle"
                            style="top:100%; width: 50%; "></i></a>
                </div>
                <h3>Baja de Usuarios </h3><br>

                <form action="adminUsuarios.php" method="post">
                    <label for="usuarios">Selecciona un usuario:</label>
                    <select style="width:50%; text-align:center;" name="usuario_id" id="usuarios">
                        <?php
                        // Conexión a la base de datos (ajusta los datos según tu configuración)
                        include "../../conexion.php";

                        // Verificar la conexión
                        if ($conexion->connect_error) {
                            die("Error de conexión: " . $conexion->connect_error);
                        }

                        // Consulta para obtener la lista de usuarios
                        $query = "SELECT id_user, Nombre FROM usuarios";
                        $result = $conexion->query($query);

                        // Imprimir opciones en la lista desplegable
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id_user']}'>{$row['Nombre']}</option>";
                        }

                        // Cerrar la conexión
                        $conexion->close();
                        ?>
                    </select>
                    <input type="submit" name="eliminar_usuario" value="Eliminar Usuario">
                </form>
            </div><br>
            <?php
        }
        ?>

        <div style="margin-left:30%;
            margin-right:30%;
            padding: 10px;
            border: 3px solid #ccc;
            border-radius: 3px;">

            <h3>Editar datos usuario</h3>
            <?php
            if ($usuariounico['Usu'] == 'Admin_Sitelecom') {
                include "../../conexion.php";
                $query1 = "SELECT * FROM usuarios
";
                $result1 = $conexion->query($query1);
                ?>
                <button type="submit" style="background:green; width:28%; margin: 20px; "
                    onclick="misDatos(<?php echo $id_user['id_user']?>)">Obtener mis datos</button>
                <br>
                <?php
            } else {
                ?>
                <div class="t">
                    <a href="../../home/principal.php"><i class="bi bi-arrow-left-circle"
                            style="top:100%; width: 50%; "></i></a>
                </div>
                <button type="submit" style="background:green; width:28%; margin: 20px; "
                    onclick="misDatos2(<?php echo  $id_user['id_user'] ?>)">Obtener mis datos</button>
                <?php
            }
            ?>

            <form id="registroForm" method="POST" action="adminUsuarios.php">
                <br>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="Nombre" class="Nombre" name="Nombre" placeholder="Ingresa tu nombre completo" required value=''>
                </div>

                <div class="form-group1">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contra" class="cont" name="contra" placeholder="Minimo 8 Caracteres" required pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ.,;:¡!¿?&$%#@*_]{8,20}" title="Solo se permiten letras, números y algunos caracteres especiales">
                    <i class="bi bi-eye-fill" id="eyeIcon" onclick="togglePasswordVisibility()"></i>
                    <i class="bi bi-eye-slash-fill" id="slashEyeIcon" onclick="togglePasswordVisibility()" style="display:none;"></i>
                </div>

                <?php if ($usuariounico['Usu'] == 'Admin_Sitelecom') : ?>
                    <div class="form-group">
                        <label for="apellidos">Codigo de admin</label>
                        <input type="password" id="contra1" class="codigo" name="contra1" placeholder="Minimo 8 Caracteres" required  pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ.,;:¡!¿?&$%#@*_]{8,50}" title="Solo se permiten letras, números y algunos caracteres especiales">
                        <i class="bi bi-eye-fill" id="eyeIcon1" onclick="togglePasswordVisibility1()"></i>
                        <i class="bi bi-eye-slash-fill" id="slashEyeIcon1" onclick="togglePasswordVisibility1()" style="display:none;"></i>
                    </div>
                <?php endif; ?>

                <div style="text-align: center;">
                    <button type="submit" name="editar_usuario" style="background: orange; width: 80px; margin: 20px">Editar</button>
                </div>
            </form>
        </div>

        <!-- Agrega el enlace al archivo de SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="../sweetalert2/sweetalert2.min.js"></script>
        <!-- Agrega tu archivo de JavaScript personalizado -->
        <script src="mensajeinicio.js"></script>

        <!--funcionalidad para visualizar contraseña-->
        <script>
            function togglePasswordVisibility() {
                var passwordInput = document.getElementById('contra');
                var eyeIcon = document.getElementById('eyeIcon');
                var slashEyeIcon = document.getElementById('slashEyeIcon');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.style.display = 'none';
                    slashEyeIcon.style.display = 'inline-block';
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.style.display = 'inline-block';
                    slashEyeIcon.style.display = 'none';
                }
            }

            function togglePasswordVisibility1() {
                var passwordInput = document.getElementById('contra1');
                var eyeIcon1 = document.getElementById('eyeIcon1');
                var slashEyeIcon1 = document.getElementById('slashEyeIcon1');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon1.style.display = 'none';
                    slashEyeIcon1.style.display = 'inline-block';
                } else {
                    passwordInput.type = 'password';
                    eyeIcon1.style.display = 'inline-block';
                    slashEyeIcon1.style.display = 'none';
                }
            }
        </script>
        <script src="../AdminUsuario/adminUsuario.js"></script>

    </body>

    </html>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica qué formulario se está enviando
        if (isset($_POST['eliminar_usuario'])) {
            // Procesar el formulario de eliminación
            // Obtener el ID del usuario a eliminar
            $usuario_id = $_POST["usuario_id"];

            // Conexión a la base de datos (ajusta los datos según tu configuración)
            include '../../conexion.php';

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta para eliminar al usuario
            $query = "DELETE FROM usuarios WHERE id_user = $usuario_id";
            $resultado = $conexion->query($query);

            // Verificar si la eliminación fue exitosa
            if ($resultado) {
                echo "<script> Swal.fire({
                    icon: 'success',
                    text: 'eliminado ',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                })
                        .then(() => {
                            window.location.href = '#';
                        });</script>";
            } else {
                echo "Error al eliminar el usuario: " . $conexion->error;
            }

            // Cerrar la conexión
         
        } elseif (isset($_POST['editar_usuario'])) {
            // Procesar el formulario de edición
            // Obtén los datos del formulario
            $nombre = $_POST["Nombre"];
            $contra = $_POST["contra"];
            $codigo = $_POST["contra1"];

            if ($usuariounico['Usu'] == 'SI-TE-LE-COM-@1') {
                // Editar datos de admin
                $sql2 = "UPDATE admi SET Nombre = ?, Contraseña = ?, codigo = ? WHERE Usu = ?";
                $stmt2 = $conexion->prepare($sql2);
                $stmt2->bind_param("ssss", $nombre, $contra, $codigo, $rty);
                $result2 = $stmt2->execute();
                $stmt2->close();
            
                if ($result2) {
                    echo "<script> Swal.fire({
                        icon: 'success',
                        text: 'Actualizacion Exitosa, Cierre sesion para que todos los cambios se apliquen ',
                        timer: 2500,
                        timerProgressBar: false,
                        showConfirmButton: false,
                    })
                            .then(() => {
                                window.location.href = 'adminUsuarios.php';
                            });</script>";
                } else {
                    echo "<script> Swal.fire({
                        icon: 'error',
                        text: 'Verifica tus datos ',
                        timer: 2500,
                        timerProgressBar: false,
                        showConfirmButton: false,
                    });</script>";
                }
            } else {
                // Editar datos de usuarios
                $sql1 = "UPDATE usuarios SET Nombre = ?, Contraseña = ? WHERE Usu = ?";
                $stmt1 = $conexion->prepare($sql1);
                $stmt1->bind_param("sss", $nombre, $contra, $rty);
                $result1 = $stmt1->execute();
                $stmt1->close();
            
                if ($result1) {
                    echo "<script> Swal.fire({
                        icon: 'success',
                        text: 'Actualizacion Exitosa, Cierre sesion para que todos los cambios se apliquen ',
                        timer: 2500,
                        timerProgressBar: false,
                        showConfirmButton: false,
                    })
                            .then(() => {
                                window.location.href = 'adminUsuarios.php';
                            });</script>";
                } else {
                    echo "<script> Swal.fire({
                        icon: 'error',
                        text: 'Verifica tus datos ',
                        timer: 2500,
                        timerProgressBar: false,
                        showConfirmButton: false,
                    });</script>";
                }
            }
            

            // Cierra la conexión
            $conexion->close();
        }
    }
    ?>
<?php
}
?>
