<?php 

$accion = $_POST['accion'];
$pass = $_POST['password'];
$usuario = $_POST['usuario'];


if ($accion == 'crear') {
    //código que crea administradores


    //hashear passwords
    $opciones = array(
        'cost' => 12
    );
    $hash_password = password_hash($pass, PASSWORD_BCRYPT, $opciones);


    
    //importar la conexión
    include '../funciones/conexion.php';

    try {
        //realizar consulta a la BD
        $stmt = $conn->prepare("INSERT INTO usuarios (usuario, pass) VALUES (?, ?)");
        $stmt->bind_param('ss', $usuario, $hash_password); //bind_result trae resultados y les asigna variables
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => $accion
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
            'pass' => $e->getMessage()
        ); 
    }


    

    echo json_encode($respuesta);

}



if ($accion === 'login') {
    //código de logueo
    include '../funciones/conexion.php';


    try{
        //seleccionar el admin de la BD
        $stmt = $conn->prepare("SELECT id, usuario, pass FROM usuarios WHERE usuario = ?");
        $stmt->bind_param('s', $usuario);
        $stmt->execute();

        //loguear al usuario
        $stmt->bind_result($id_usuario, $nombre_usuario, $pass_usuario);

        $stmt->fetch();
        if ($nombre_usuario) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id' => $id_usuario,
                'nombre' => $nombre_usuario,
                'pass' => $pass_usuario
            );
        } else {
            $respuesta = array(
                'respuesta' => 'El usuario no existe'
            );
        }


        $stmt->close();
        $conn->close();
    }catch(Exception $e) {
        //tomar la excepcion
        $respuesta = array(
            'pass' => $e->getMessage()
        ); 
    }
    echo json_encode($respuesta);
}




//json es un formato de transporte entre php y js. 'die' es como un 'echo'

?>