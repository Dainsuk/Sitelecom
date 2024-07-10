<!DOCTYPE html>
<html>
<head>
    <title>Sitelecom-SGA</title>
    <link rel="icon" href="/logo1.png">
    <link rel="stylesheet" href="/login/css/login.css">
    <link rel="stylesheet" href="/login/css/cabecera.css">
    <link rel="stylesheet" href="/sweetalert2/sweetalert2.min.css">
   
    <link rel="stylesheet" href="/font/bootstrap-icons.css">
    <!-- Agrega el enlace al archivo de SweetAlert2 -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</head>
<body>
<br>
<br> 

<div id="formulario">
  
   
    <form class="form"  id="loginForm" onsubmit="borrar(); return false;">
    <img  src="/descargar.jpg"  class="color"></img>
     <div class="">
     <h1 class="animate__animated animate__backInLeft">Inicio de Sesion</h1>  
     
     <label for="usuario">Usuario:</label><br>
            <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" ><br><br>

            <label for="contrasena">Contraseña:</label>
            
            <div class="password-container">
    <input type="password" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña">
    <i class="bi bi-eye-fill" id="eyeIcon" onclick="togglePasswordVisibility()"></i>
    <i class="bi bi-eye-slash-fill" id="slashEyeIcon" onclick="togglePasswordVisibility()" style="display:none;"></i>
</div>
<br><br>
    
    <button class="boton7" type="submit" onclick="validarLogin()">Iniciar Sesión</button><br><br>
    <a  href="/telecom/RecuperaClave1.php">¿Olvidaste tu contraseña?</a>
    <div class="border"></div>
     <button type="button" class="d" onclick="window.location.href='/registro/re.php'">Crear Cuenta</button>
 
    
    </form> 
 </div>
 </div>
    <!-- Agrega el enlace al archivo de SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../sweetalert2/sweetalert2.min.js"></script>
    <!-- Agrega tu archivo de JavaScript personalizado -->
    <script src="mensajeinicio.js"></script>

    <!--funcionalidad para visualizar contraseña-->
    <script>
function togglePasswordVisibility() {
    var passwordInput = document.getElementById('contrasena');
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
function borrar(){
    document.getElementById("loginForm").reset();
}
</script>
    
</script>
</body>
</html>
