<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
include '../conexion.php';

// Realizar la consulta
$sql = "SELECT codigo FROM admi WHERE id_user = 1";
$result = mysqli_query($conexion, $sql);

// Verificar si se obtuvo algún resultado
if ($result) {
    // Obtener la fila como un array asociativo
    $fila = mysqli_fetch_assoc($result);

    // Obtener el valor del campo 'codigo'
    $codigo = $fila['codigo'];

    // Liberar el resultado
    mysqli_free_result($result);
} else {
    // Manejar el caso en que la consulta no fue exitosa
    $codigo = "Error al obtener el código";
}
?>
    <title>Recuperar Contraseña</title>
    <!-- Estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- Estilos personalizado -->
    <link rel="stylesheet" href="./estilos/login.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

    <div class="card text-center contenedor mx-auto my-auto mt-5" style="text-align: center;">
         <img src="https://www.sitelecom.com.mx/images/logo1-300x135.png" alt="logo sitelecom"class="imagen-esquina-superior-izquierda" width="100%" height="100px" >
        <div class="card-header">
          <strong>Recuperar Contraseña</strong> 
        </div>
        <div class="card-body">
            <form id="recupera-clave"  onsubmit="borrar(); return false;" >
                <div class="mb-3">
                  <label for="" class="form-label"><i class="bi bi-person-fill"></i> Nombre de usuario</label>
                  <input type="text" class="form-control" id="NombreUsusario" placeholder="Ingresa tu usuario">
                </div>
                <label></label>
                <div class="password-container">
                  <label for="exampleInputPassword1" class="form-label">Codigo de administrador</label>
                  <input type="password" class="form-control" id="CodigoAdmin" placeholder="Ingresa el codigo de administrador" >
                  <i class="bi bi-eye-fill" id="eyeIcon" onclick="togglePasswordVisibility()"></i>
                  <i class="bi bi-eye-slash-fill" id="slashEyeIcon" onclick="togglePasswordVisibility()" style="display:none;"></i>
                </div>

                <input type="hidden" id="codigo" name="codigo" value="<?php echo htmlspecialchars($codigo); ?>"><br>

                <div>
                  <p type="text"  id="ContrasenaUsuario" > 
                </div>
                <br>
                <button type="button" class="btn btn-primary" onclick="RecuperaClave()">Enviar</button>
                <button type="submit" class="btn btn-danger" onclick="window.location.href='../index.php'">Regresar</button>
                
                
    <!--funcionalidad para visualizar contraseña-->
    <script>
      function togglePasswordVisibility() {
          var passwordInput = document.getElementById('CodigoAdmin');
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
       document.getElementById("recupera-clave").reset();
       document.getElementById('ContrasenaUsuario').innerText = '';
       }

      
      </script>
               
               
              </form>
        </div>
      </div>

</body>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="./js/login.js"></script>
</html>
