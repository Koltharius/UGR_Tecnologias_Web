<?php
session_start();
require './ConexionBD.php';

//Se borra la cola de la BD con todos los usuarios que esten apuntados a ella

if ($_POST) {
    $sql = "DELETE FROM `revisiones` where codigo_revision='$_POST[codigo]'";
    if ($_SESSION['Rol'] === 'administrador') {
        if (conexion()->query($sql) === TRUE) {
            ?>
            <script>
                alert("El registro se ha borrado correctamente");
                window.location = "GestionColasAdministrador.php";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("El registro no ha podido ser borrado");
                window.location = "GestionColasAdministrador.php";
            </script>
            <?php
        }
    } else if ($_SESSION['Rol'] === 'profesor') {
        if (conexion()->query($sql) === TRUE) {
            ?>
            <script>
                alert("El registro se ha borrado correctamente");
                window.location = "GestionColasProfesor.php";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("El registro no ha podido ser borrado");
                window.location = "GestionColasProfesor.php";
            </script>
            <?php
        }
    }
    mysqli_close(conexion());
}
?>
<script>
</script>


