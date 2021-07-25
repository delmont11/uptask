<?php 

function obtenerPaginaActual() {
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);
    return $pagina;
};


//Consultas

//Obtener todos los proyectos
function obtenerProyectos(){
    include 'conexion.php';
    try {
        return $conn->query('SELECT id, nombre FROM proyectos');
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
?>