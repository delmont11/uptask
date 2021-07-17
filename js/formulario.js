eventListener();

function eventListener() {
    document.querySelector('#formulario').addEventListener('submit', validarRegistro);
}



function validarRegistro(e) {
    //preventDefault hace que el form no se envíe
    e.preventDefault();

    var usuario = document.querySelector('#usuario').value,
        password = document.querySelector('#password').value,
        tipo = document.querySelector('#tipo').value;
    //VALIDACIÓN DE CAMPOS
    if (usuario === '' || password === '') {
        Swal.fire({
            icon: 'error',
            title: 'ERROR',
            text: 'Ambos campos son obligatorios',
            footer: ''
        })
    } else {
        //DATOS QUE SE ENVIAN AL SERVIDOR
        var datos = new FormData(); // Estructura el llamado a ajax, darle llave y valor.
        datos.append('usuario', usuario);
        datos.append('password', password);
        datos.append('accion', tipo);



        //CREAR LLAMADO A AJAX
        var xhr = new XMLHttpRequest();

        //ABRIR LA CONEXIÓN
        xhr.open('POST', 'inc/modelos/modelo-admin.php', true);

        //RETORNO DE DATOS
        xhr.onload = function() {
            if (this.status === 200) {
                console.log(JSON.parse(xhr.responseText)); //responseText trae el json del .php vinculado
                //JSON.parse convierte la respuesta en un object
            }
        }

        //ENVIAR LA PETICIÓN
        xhr.send(datos);
    }

}