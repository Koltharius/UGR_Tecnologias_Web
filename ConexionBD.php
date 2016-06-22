<?php

//Parametros para la conexion con la BD

function conexion() {
    $servername = "solaris.ugr.es";
    $username = "ejercicio_pw";
    $password = "pass_ejercicio_pw";
    $dbname = "75152552Y";

    $conexion = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conexion) {
        die("Conexion Fallida: " . mysqli_connect_error());
    }
    return $conexion;
}

?>
