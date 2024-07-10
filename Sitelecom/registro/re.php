
<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Registro</title>
    <!-- Agrega el enlace al archivo de SweetAlert2 -->

    <link rel="stylesheet" type="text/css" href="estilos.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../font/bootstrap-icons.css">
</head>
<body>

<br>
<div class="container">
<img src="../login/sitelecom.png">
<div class="border"></div>
<h3>Registro</h3>
    <div class="t">
    <a href="../index.php"><i class="bi bi-arrow-left-circle"></i></a>
</div>
    <form id="registroForm" onsubmit="borrar(); return false;">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingresa nombre completo" required><br><br>

        <label for="email">Nombre de Usuario:</label>
        <input type="text" id="usuario" name="usuario" placeholder="Crea un usuario" required><br><br>

        <label for="password">Contraseña:</label>
        <div class="password-container">
        <input type="password" id="password" name="password" placeholder="Minimo 8 caracteres" required>
        <i class="bi bi-eye-fill" id="eyeIcon" onclick="togglePasswordVisibility()"></i>
        <i class="bi bi-eye-slash-fill" id="slashEyeIcon" onclick="togglePasswordVisibility()" style="display:none;"></i>
        <br>
        </div>
        <label for="password2">Codigo de administrador:</label>
        <div class="password-container2">
        <input type="password" id="password2" name="password2" placeholder="Ingresa el codigo de administrador" required><br><br>
        <i class="bi bi-eye-fill" id="eyeIconn" onclick="togglePasswordVisibility1()"></i>
        <i class="bi bi-eye-slash-fill" id="slashEyeIconn" onclick="togglePasswordVisibility1()" style="display:none;"></i>
        </div>

        <button type="submit" onclick="registrarUsuario()" >Registrarse</button>
    </form>
</div>

    <!-- Agrega el enlace al archivo de SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Agrega tu archivo de JavaScript personalizado -->
    <script src="re.js"></script>

    <!--funcionalidad para visualizar contraseña-->
    <script>
function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    var eyeIcon = document.getElementById('eyeIcon');
    var slashEyeIcon = document.getElementById('slashEyeIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.style.display = 'none'; // Oculta el ícono de ojo normal
        slashEyeIcon.style.display = 'inline-block'; // Muestra el ícono de ojo tachado
    } else {
        passwordInput.type = 'password';
        eyeIcon.style.display = 'inline-block'; // Muestra el ícono de ojo normal
        slashEyeIcon.style.display = 'none'; // Oculta el ícono de ojo tachado
    }
}
function togglePasswordVisibility1() {
    var passwordInput = document.getElementById('password2');
    var eyeIcon = document.getElementById('eyeIconn');
    var slashEyeIcon = document.getElementById('slashEyeIconn');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.style.display = 'none'; // Oculta el ícono de ojo normal
        slashEyeIcon.style.display = 'inline-block'; // Muestra el ícono de ojo tachado
    } else {
        passwordInput.type = 'password';
        eyeIcon.style.display = 'inline-block'; // Muestra el ícono de ojo normal
        slashEyeIcon.style.display = 'none'; // Oculta el ícono de ojo tachado
    }
}

function borrar(){
    document.getElementById("registroForm").reset();
}
</script>
</body>
</html>
