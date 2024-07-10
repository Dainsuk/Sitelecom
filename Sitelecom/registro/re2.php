<?php
// Conectarse a la base de datos (reemplaza estos datos con los tuyos)
include '../conexion.php';

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST["nombre"];
$usuario = $_POST["usuario"];
$password = $_POST["password"];
$password2 = $_POST["password2"];


/// ...

// Realiza alguna lógica de validación y seguridad aquí (evita SQL injection, etc.)
$sql1 = "SELECT codigo FROM admi WHERE id_user =1";
$result1 = mysqli_query($conexion, $sql1);

// Extraer el valor de la columna 'codigo' del resultado
$row = mysqli_fetch_assoc($result1);
$codigoAdmin = $row['codigo'];

if ($nombre == "" || $usuario == "" || $password == "" || $password2 == "") {
    echo "vacio";
} else {
    if (strlen($password) < 8) {
        echo "8caracteres";
    } else {
        if (preg_match('/\d/', $nombre)) {
            echo "numeros";
        } else {
            $sql = "SELECT * FROM usuarios WHERE Usu = '$usuario'";
            $result = mysqli_query($conexion, $sql);

            if (mysqli_num_rows($result) > 0 && $password2 === $codigoAdmin) {
                // El usuario ya está registrado en la base de datos y la contraseña coincide con el código de admin.
                echo "registrado";
            } else {
                if ($password2 !== $codigoAdmin) {
                    echo "codigo";
                } else {
                    $sql = "INSERT INTO usuarios (Nombre, Usu, Contraseña) VALUES ('$nombre', '$usuario', '$password')";

                    if ($conexion->query($sql) === TRUE) {
                        

                        // Redirigir al usuario a la página de inicio de sesión
                
                        echo "exito";
                    } else {
                        echo "error";
                    }
                }
            }
        }
    }
}

// Insertar los datos en la base de datos
$conexion->close();


?>
