<?php 
    include 'inc/funciones/sesion.php';//la sesión la incluye en la página que necesita login
    include 'inc/funciones/funciones.php';
    include 'inc/templates/header.php'; 
    include 'inc/templates/barra.php'; 


    //obtener el ID de la URL
    if (isset($_GET['id_proyecto'])) {
        $id_proyecto = $_GET['id_proyecto'];
    } 

?>


<div class="contenedor">
    
    <?php include 'inc/templates/sidebar.php';  ?>

    <main class="contenido-principal">
            <?php 
                $proyecto = obtenerNombreProyecto($id_proyecto);

                if ($proyecto):?>
                <h1>
                    <?php foreach($proyecto as $nombre); ?>
                            <span><?php echo $nombre['nombre']; ?></span>
                    <?php T_ENDFOREACH; ?>
                </h1>

                <form action="#" class="agregar-tarea">
                    <div class="campo">
                        <label for="tarea">Tarea:</label>
                        <input type="text" placeholder="Nombre Tarea" class="nombre-tarea"> 
                    </div>
                    <div class="campo enviar">
                        <input type="hidden" id="id-proyecto" value="<?php echo $id_proyecto ?>" value="id_proyecto">
                        <input type="submit" class="boton nueva-tarea" value="Agregar">
                    </div>
                </form>
        <?php 
        
                else: 
                    //si no hay proyecto seleccionado
                    echo "<p>Selecciona un proyecto para empezar</p>"; 

                endif;
        
        ?>

        <h2>Listado de tareas:</h2>

        <div class="listado-pendientes">
            <ul>
                <?php  
                $tareas = obtenerTareasProyecto($id_proyecto);
                if ($tareas->num_rows > 0) {
                    //si hay tareas ejecuta esto
                    foreach ($tareas as $tarea): ?>
                        <li id="tarea:<?php echo $tarea['id'] ?>" class="tarea">
                            <p><?php echo $tarea['nombre'] ?></p>
                            <div class="acciones">
                                <i class="far fa-check-circle <?php echo ($tarea['estado']=== '1' ? 'completo' : ""); ?>"></i>
                                <i class="fas fa-trash"></i>
                            </div>
                        </li>  
                    <?php endforeach; 
                } else {
                    //no hay tareas
                    echo "<p>No hay tareas en este proyecto</p>";
                }             
                ?>

                
            </ul>
        </div>
    </main>
</div><!--.contenedor-->

<?php include 'inc/templates/footer.php' ?>