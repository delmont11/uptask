<?php 

$accion = $_POST['accion'];
$id_proyecto = (int) $_POST['id_proyecto'];
$tarea = $_POST['tarea'];

if ($accion == 'crear') {
    //código que crea inserta proyecto

    
    //importar la conexión
    include '../funciones/conexion.php';

    try {
        //realizar consulta a la BD
        $stmt = $conn->prepare("INSERT INTO tarea (nombre, id_proyecto) VALUES (?, ?)");
        $stmt->bind_param('si', $tarea, $id_proyecto); //bind_result trae resultados y les asigna variables
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'accion' => $accion,
                'tarea' => $tarea
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