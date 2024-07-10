

function validarR() {
    // Obtener los valores del usuario y la contraseña

    const Des = document.getElementById("Des").value;
    const exis = document.getElementById("exis").value;


    // Realizar la solicitud AJAX para validar en el servidor
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "insert.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const respuesta = xhr.responseText;
            if(respuesta=="Registrado"){
                Swal.fire({
                    text:"Este epp ya esta registrado",
                    
                    timer: 2000,
                    timerProgressBar: false, 
                    showConfirmButton: false,
                
                    });

            }else{
                if (respuesta == "exito") {
                    // Si la validación es exitosa, muestra la alerta SweetAlert2 de éxito
                    Swal.fire({
                        title:"Se a realizado el registro",
                        icon: 'success',
                        timer: 2500,
                        timerProgressBar: false, 
                        showConfirmButton: false,
                    
                        })
                        .then(() => {
                            window.location.href = 'reproducto.php';
                        });
                }else{
                    if (respuesta == "vacio") {
                        // Si la validación es exitosa, muestra la alerta SweetAlert2 de éxito
                        Swal.fire({
                            text:"Completa los campos para realizar un registro",
                            icon: 'warning',
                            timer: 2500,
                            timerProgressBar: false, 
                            showConfirmButton: false,
                        
                            });
                            
                    }else{
                        if (respuesta == "letras") {
                            // Si la validación es exitosa, muestra la alerta SweetAlert2 de éxito
                            Swal.fire({
                                text:"El campo de cantidad solo acepta datos numericos enteros",
                                icon: 'warning',
                                timer: 2500,
                                timerProgressBar: false, 
                                showConfirmButton: false,
                            
                                });
                                
                        }else{
                            Swal.fire({
                                text:"error al guardar el registro",
                                icon: 'error',
                                timer: 2500,
                                timerProgressBar: false, 
                                showConfirmButton: false,
                            
                                });
                        }
                    }  
                } 
            }
           
        }
    };
    xhr.send("Des=" + Des + "&exis=" + exis);
}