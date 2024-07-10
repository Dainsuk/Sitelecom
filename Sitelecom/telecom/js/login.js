/* Recuperar Contraseña */
function RecuperaClave(){
    let NombreUsusario = $('#NombreUsusario').val();
    let CodigodeAdministrador=$('#CodigoAdmin').val();
    let codigo=$('#codigo').val();

    if(NombreUsusario == '' || CodigodeAdministrador == ''){
        Swal.fire({
            text:"Completa todos los Campos",
            icon: 'info',
            timer: 2000,
            timerProgressBar: false, 
            showConfirmButton: false,
        
            });
    }else
    {
        if(CodigodeAdministrador != codigo)
        {
            Swal.fire({
                        text:"El Codigo de Admistrador es incorrecto",
                        icon: 'info',
                        timer: 2000,
                        timerProgressBar: false, 
                        showConfirmButton: false,
                    
                        });
        }else
        {
            $.ajax({
                // la URL para la petición
                url : './php/RecuperarClave.php',
            
                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data : { NomUsuario : NombreUsusario},
            
                // especifica si será una petición POST o GET
                type : 'POST',
            
                // el tipo de información que se espera de respuesta
                //dataType : 'json',
            
                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success : function(Dato) {
                    if(Dato == '' || Dato == null || Dato == '\r\n\r\n\r\n'){
                        $('#ContrasenaUsuario').text('No se encuentra el usuario');
                    }else{
                        $('#ContrasenaUsuario').text(Dato);
                    }
                }
            });
        }
    }
}

/* Crear usuasrio */

