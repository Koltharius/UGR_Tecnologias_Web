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
    $sql = "DELETE FROM `revisiones` where codigo_revision='$_POST[codigo]'";

    if ($_SESSION['Rol'] === 'administrador') {
        if ($con->query($sql) === TRUE) {
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
    } else if($_SESSION['Rol'] === 'profesor'){
        if ($con->query($sql) === TRUE) {
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


    mysqli_close($con);
}
?>
<script>
</script>


