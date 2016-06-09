<?php
session_start();
if ($_POST) {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "gestor_turnos";
    // Create connection
    $con = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_error($con));
    }
    $sql = "DELETE FROM `usuarios` where Email='$_POST[email]'";

    if ($con->query($sql) === TRUE) {
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
mysqli_close($con);
?>



