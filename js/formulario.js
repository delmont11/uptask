eventListener();

function eventListener() {
    document.querySelector('#formulario').addEventListener('submit', validarRegistro);
}



function validarRegistro(e) {
    //preventDefault hace que el form no se envíe
    e.preventDefault();

    var usuario = document.querySelector('#usuario').value,
        password = document.querySelector('#password').value;

    if (usuario === '' || password === '') {
        Swal.fire({
            icon: 'error',
            title: 'ERROR',
            text: 'Ambos campos son obligatorios',
            footer: ''
        })
    } else {
        Swal.fire({
            icon: 'success',
            title: '¡Perfecto!',
            text: 'Completaste el registro con éxito',

        })
    }

}