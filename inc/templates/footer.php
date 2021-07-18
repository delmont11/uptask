<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 
    $actual = obtenerPaginaActual();
    if ($actual === 'crear-cuenta' || $actual === 'login') {
        echo '<script src="js/formulario.js"></script>';
    } else {
        echo '<script src="js/scripts.js"></script>';
    }



?>




</body>
</html>