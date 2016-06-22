<?php

session_start();
require './ConexionBD.php';

$alumno = $_SESSION['Codigo_Alumno'];

if ($_POST) {
    //Genero la consulta para saber si el usuario está activo
    $sql = "DELETE FROM alumno WHERE Codigo_Alumno='$alumno'";
    //Envio la consulta a MySQL.
    if (conexion()->query($sql) === TRUE) {
        echo "<script>alert('Se ha borrado de la cola.');window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('No se ha podido borrar de la cola.');window.location.href='VerMiPosicion.php';</script>";
    }
}
mysqli_close(conexion());
?>