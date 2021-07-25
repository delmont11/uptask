eventListeners();

//lista de proyectos 
var listaProyectos = document.querySelector('ul#proyectos');

function eventListeners() {
    //boton para crear proyecto
    document.querySelector('.crear-proyecto a').addEventListener('click', nuevoProyecto);

    //boton para una nueva tarea
    document.querySelector('.nueva-tarea').addEventListener('click', agregarTarea);
}

function nuevoProyecto(e) {
    e.preventDefault();

    //crea un input para nuevo proyecto
    var nuevoProyecto = document.createElement('li');
    nuevoProyecto.innerHTML = '<input type="text" id="nuevo-proyecto">';
    listaProyectos.appendChild(nuevoProyecto);

    //seleccionar el input con id = nuevo-proyecto
    var inputNuevoProyecto = document.querySelector('#nuevo-proyecto');

    //presionando ENTER crea el proyecto
    inputNuevoProyecto.addEventListener('keypress', function(e) {
        //captura la tecla en la variable enter
        var tecla = e.which || e.keyCode;

        if (tecla === 13) {
            guardarProyectoDB(inputNuevoProyecto.value);
            listaProyectos.removeChild(nuevoProyecto);
        }
    })


}

function guardarProyectoDB(nombreProyecto) {
    //CREAR LLAMADO A AJAX
    var xhr = new XMLHttpRequest();
    //enviar datos por FormDate()
    var datos = new FormData();
    datos.append('proyecto', nombreProyecto);
    datos.append('accion', 'crear');
    //ABRIR LA CONEXIÓN
    xhr.open('POST', 'inc/modelos/modelo-proyecto.php', true);

    //RETORNO DE DATOS
    xhr.onload = function() {
        if (this.status === 200) {
            //obtener datos de la respuesta 
            var respuesta = JSON.parse(xhr.responseText);
            var proyecto = respuesta.nombre_proyecto,
                id_proyecto = respuesta.id_insertado,
                tipo = respuesta.tipo,
                resultado = respuesta.respuesta;



            //comprobar la inserción
            if (resultado === 'correcto') {
                //fue exitoso
                if (tipo === 'crear') {
                    //se creo un nuevo proyecto
                    //inyectar en el html
                    let nuevoProyecto = document.createElement('li');
                    nuevoProyecto.innerHTML = `
                    <a href="index.php?id_proyecto=${id_proyecto}" id="${id_proyecto}">
                        ${proyecto}
                    </a>
                    `;
                    //agregar al html
                    listaProyectos.appendChild(nuevoProyecto);

                    //enviar alerta
                    Swal.fire({
                        icon: 'success',
                        title: '¡PROYECTO CREADO!',
                        text: `El proyecto ${proyecto} se ha creado`,
                        footer: ''
                    })

                    //redicreccionar a la nueva URL
                    .then(resultado => {
                        if (resultado.value) {
                            window.location.href = `index.php?id_proyecto=${id_proyecto}`;
                        }
                    })

                } else {
                    //se actualizó o se eliminó
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'Hubo un error',
                    footer: ''
                })
            }
        }
    }

    //ENVIAR LA PETICIÓN
    xhr.send(datos);

}
//Agregar una nueva tarea al proyecto actual
function agregarTarea(e) {
    e.preventDefault();
    let nombreTarea = document.querySelector('.nombre-tarea').value;
    //validar que el campo tenga algo escrito 
    if (nombreTarea === '') {
        Swal.fire({
            icon: 'error',
            title: 'ERROR',
            text: 'Este campo no puede estar vacío',
            footer: ''
        })
    } else {
        //si la tarea existe, inserta en PHP

    }
}