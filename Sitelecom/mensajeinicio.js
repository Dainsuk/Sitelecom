function validarLogin() {
    // Obtener los valores del usuario y la contraseña

    const usuario = document.getElementById("usuario").value;
    const contrasena = document.getElementById("contrasena").value;


    // Realizar la solicitud AJAX para validar en el servidor
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "validar.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const respuesta = xhr.responseText;
            if(respuesta=="Campos Vacios"){
                Swal.fire({
                    text:"Completa los campos solicitados",
                    icon: 'warning',
                    timer: 2000,
                    timerProgressBar: false, 
                    showConfirmButton: false,
                
                    });

            }else{  
                if (respuesta === "exito") {
                    // Si la validación es exitosa, muestra la alerta SweetAlert2 de éxito
                    Swal.fire({
                        title:"Datos correctos",
                        icon: 'success',
                        timer: 2500,
                        timerProgressBar: false, 
                        showConfirmButton: false,
                    
                        })
                        .then(() => {
                            window.location.href = '/home/principal.php';
                        });
                } else {
                    // Si la validación falla, muestra la alerta SweetAlert2 de error
                    Swal.fire({
                        title:"Datos Erroneos",
                        icon: 'error',
                        timer: 2000,
                        timerProgressBar: false, 
                        showConfirmButton: false,
                    
                        });
                    
                }
            }
           
        }
    };
    xhr.send("usuario=" + usuario + "&contrasena=" + contrasena);
}
