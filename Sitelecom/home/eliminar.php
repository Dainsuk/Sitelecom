<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado el formulario de eliminación
    if(isset($_POST['eliminarUsuario'])) {
        // Procesar el formulario de eliminación aquí
        $selectedUserId = $_POST["usuario_id"];
        // Resto del código de eliminación...
        // ...
    } else {
        // Obtén los datos del formulario de edición
        $nombre = $_POST["Nombre"];
        $contra = $_POST["contra"];
        $codigo = $_POST["contra1"];

        // Verifica que los campos no estén vacíos
        if (empty($nombre) || empty($contra) || empty($codigo)) {
            echo "<script> Swal.fire({
                    icon: 'error',
                    text: 'Por favor, completa todos los campos',
                    timer: 2500,
                    timerProgressBar: false,
                    showConfirmButton: false,
                });
                </script>";
        } else {
            if ($usuariounico['Usu'] == $usuariounico['Usu']) {
                // Editar datos de admi
                $sql2 = "UPDATE admi SET Nombre = ?, Contraseña = ?, codigo = ? WHERE Usu = ?";
                $stmt2 = $conexion->prepare($sql2);
                $stmt2->bind_param("ssss", $nombre, $contra, $codigo, $rty);
                $result2 = $stmt2->execute();
                $stmt2->close();

                if ($result2) {
                    echo "<script> Swal.fire({
                        icon: 'success',
                        text: 'Actualización Exitosa, cierre sesión para que todos los cambios se apliquen',
                        timer: 2500,
                        timerProgressBar: false,
                        showConfirmButton: false,
                    })
                            .then(() => {
                                window.location.href = '#';
                            });
                    </script>";
                } else {
                    echo "<script> Swal.fire({
                        icon: 'error',
                        text: 'Verifica tus datos',
                        timer: 2500,
                        timerProgressBar: false,
                        showConfirmButton: false,
                    });
                    </script>";
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
                        text: 'Actualización Exitosa, cierre sesión para que todos los cambios se apliquen',
                        timer: 2500,
                        timerProgressBar: false,
                        showConfirmButton: false,
                    })
                            .then(() => {
                                window.location.href = '../home/mostrar.php';
                            });
                    </script>";
                } else {
                    echo "<script> Swal.fire({
                        icon: 'error',
                        text: 'Verifica tus datos',
                        timer: 2500,
                        timerProgressBar: false,
                        showConfirmButton: false,
                    });
                    </script>";
                }
            }
        }
    }

    // Cierra la conexión
    $conexion->close();
}
?>


