<?php
session_start();
require './ConexionBD.php';

//Se borra la cola de la BD el usuario con todos los recursos que esten relacionados a el

if ($_POST) {
    $sql = "DELETE FROM `usuarios` where Email='$_POST[email]'";

    if (conexion()->query($sql) === TRUE) {
        ?>
        <script>
            alert("El registro se ha borrado correctamente");
            window.location = "GestionUsuarioAdministrador.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("El registro no ha podido ser borrado");
            window.location = "GestionUsuarioAdministrador.php";
        </script>
        <?php

    }
}
mysqli_close(conexion());
?>



