<?php 





$accion = $_POST['accion'];
$proyecto = $_POST['proyecto'];

if ($accion == 'crear') {
    //código que crea inserta proyecto

    
    //importar la conexión
    include '../funciones/conexion.php';

    try {
        //realizar consulta a la BD
        $stmt = $conn->prepare("INSERT INTO proyectos (nombre) VALUES (?)");
        $stmt->bind_param('s', $proyecto); //bind_result trae resultados y les asigna variables
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => $accion,
                'nombre_proyecto' => $proyecto
            );
        }else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    }catch(Exception $e) {
        //tomar la excepcion
        $respuesta = array(
            'error' => $e->getMessage()
        ); 
    }


    

    echo json_encode($respuesta);

}

?>