function registrarUsuario() {
    const nombre = document.getElementById("nombre").value;
    const usuario = document.getElementById("usuario").value;
    const password = document.getElementById("password").value;
    const password2 = document.getElementById("password2").value;
 

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "re2.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const respuesta = xhr.responseText;
            if(respuesta=="exito"){
                Swal.fire({
                    icon: 'success',
                    text:"Se registro correctamente",
                    timer: 5000,
                    timerProgressBar: false, 
                    showConfirmButton: false,
                
                    })
                    .then(() => {
                      
                        window.location.href = '../index.php';
                    });

            }else{
                if (respuesta == "registrado") {
                    // Si la validación es exitosa, muestra la alerta SweetAlert2 de éxito
                    Swal.fire({
                        text:"el usuario ya existe",
                        timer: 2000,
                        timerProgressBar: false, 
                        showConfirmButton: false,
                    
                        });
                       
                } else {
                    // Si la validación falla, muestra la alerta SweetAlert2 de error
                    if (respuesta == "vacio") {
                        // Si la validación es exitosa, muestra la alerta SweetAlert2 de éxito
                        Swal.fire({
                            text:"completa todos los campos solicitados ",
                            timer: 2000,
                            timerProgressBar: false, 
                            showConfirmButton: false,
                        
                            });
                }else{
                    if (respuesta == "numeros") {
                        // Si la validación es exitosa, muestra la alerta SweetAlert2 de éxito
                        Swal.fire({
                            text:"El compo de nombre solo debe contener letras",
                            timer: 2000,
                            timerProgressBar: false, 
                            showConfirmButton: false,
                        
                            });
                }else{
                    if (respuesta == "codigo") {
                        // Si la validación es exitosa, muestra la alerta SweetAlert2 de éxito
                        Swal.fire({
                            text:"Codigo Incorrecto",
                            timer: 2000,
                            timerProgressBar: false, 
                            showConfirmButton: false,
                        
                            });
                
                }else{
                    if (respuesta == "8caracteres") {
                        // Si la validación es exitosa, muestra la alerta SweetAlert2 de éxito
                        Swal.fire({
                            text:"Caracteres insuficientes en la contraseña",
                            timer: 2000,
                            timerProgressBar: false, 
                            showConfirmButton: false,
                        
                            });
                }
                else{
                    Swal.fire({
                        text:"error en el registro",
                        timer: 2000,
                        timerProgressBar: false, 
                        showConfirmButton: false,
                    
                        });
                }
            }
           
        }
    }
}
            }}
    
};

    const datos = "nombre=" + nombre + "&usuario=" + usuario + "&password=" + password + "&password2=" + password2;
    xhr.send(datos);

}
