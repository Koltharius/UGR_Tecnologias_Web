<?php

session_start();
require './ConexionBD.php';

$codigo = $_GET['codigo'];
$cola_no_activa = 'No activa';
$_SESSION['codigo']=$codigo;
$estado_cola = "Activa";
$sql = "UPDATE revisiones SET Estado='$estado_cola' WHERE Codigo_Revision='$codigo' and Estado='$cola_no_activa'";
if (conexion()->query($sql) === TRUE) {
    ?>
    <script>
        window.location = "GestionTurnos.php";
    </script>
    <?php
}
else {
?>
    <script>
    alert('Cola ya activa');
    window.location = "GestionTurnos.php";
    </script>
<?php 
} 
?>

