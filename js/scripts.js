eventListeners();

//lista de proyectos 
var listaProyectos = document.querySelector('ul#proyectos');

function eventListeners() {
    //boton para crear proeycto
    document.querySelector('.crear-proyecto a').addEventListener('click', nuevoProyecto)
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
            console.log(JSON.parse(xhr.responseText));
        }
    }

    //ENVIAR LA PETICIÓN
    xhr.send(datos);







    // //inyectar el HTML
    // var nuevoProyecto = document.createElement('li');
    // nuevoProyecto.innerHTML = `
    //     <a href="#">
    //         ${nombreProyecto}
    //     </a>
    // `;

    // listaProyectos.appendChild(nuevoProyecto)
}