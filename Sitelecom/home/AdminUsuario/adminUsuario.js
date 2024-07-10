

function misDatos(id_usu){
    console.log(id_usu);
    buscaUsuario2(id_usu);
}
function buscaUsuario2(valor) {
    var valorUsuario2 = valor;
    console.log('hola ' + valorUsuario2);

    $.ajax({
        url: "buscarUsuario2.php",
        type: "POST",
        data: { valor: valorUsuario2},
        success: function (data) {
            // Parsear los datos devueltos a un objeto JavaScript
            var datos = JSON.parse(data);
            // Imprimir los datos en la consola
            console.log(datos);
            console.log(datos[0].Nombre);
            $('.Nombre').val(datos[0].Nombre);
            $('.codigo').val(datos[0].codigo);
            $('.usu').val(datos[0].Usu);
            $('.cont').val(datos[0].Contraseña);

        }
    });
}
function Editar() {
    var formData = $('#registroForm').serialize();

    console.log(formData);

    $.ajax({
        type: "POST",
        url: "editarUsuario.php",
        data: formData,
        success: function (response) {
            if (response == 1) {
                alert('Se han modificado los datos del usuario');
            } else {
                alert('Ocurrió un error');
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}


function eliminarUsuario(){
    let valort = $("#usuNormal").val();
    console.log(valort);

    $.ajax({
        url: "borrrarUsuario.php",
        type: "POST",
        data: { valor: valort},
        success: function (data) {
            if(data == 1){
                alert('Se ha eliminado el usuario');
            }else{
                alert('No fue posible eliminar el usuario');
            }

        }
    });
}

function misDatos2(id_usu){
    console.log(id_usu);
    buscaUsuario3(id_usu);
}
function buscaUsuario3(valor) {
    var valorUsuario2 = valor;
    console.log('hola ' + valorUsuario2);

    $.ajax({
        url: "buscarUsuario3.php",
        type: "POST",
        data: { valor: valorUsuario2},
        success: function (data) {
            // Parsear los datos devueltos a un objeto JavaScript
            var datos = JSON.parse(data);
            // Imprimir los datos en la consola
            console.log(datos);
            console.log(datos[0].Nombre);
            $('.Nombre').val(datos[0].Nombre);
            $('.usu').val(datos[0].Usu);
            $('.cont').val(datos[0].Contraseña);

        }
    });
}