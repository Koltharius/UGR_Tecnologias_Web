<?php

session_start();
require './ConexionBD.php';
//Se cogen los datos del usuario introducidos en el formulario PosicionCola.php
$user = $_POST['email'];
$passwd = $_POST['cod_usuario'];

//Genero la consulta para saber si el usuario está activo
$sql = "SELECT * FROM alumno WHERE Email='$user'";

//Envio la consulta a MySQL.
$resultado = mysqli_query(conexion(), $sql);

//Si esta en la BD guardo sus datos en la session, si no se le indica al 
//alumno que no esta inscrito en esa cola y se le redirige a la pagina de inicio
if ($resultado->num_rows === 1) {
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

    if ($passwd == $row['Codigo_Alumno']) {
        $_SESSION['Codigo_Alumno'] = $row['Codigo_Alumno'];
        $_SESSION['loggedin'] = true;
        $_SESSION['Codigo_Revision'] = $row['Codigo_Revision'];
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
        echo '<script>window.location.href="VerMiPosicion.php";</script>';
    } else {
        echo '<script>alert("Codigo incorrecto");window.location.href="index.php"</script>';
    }
} else {
    echo "<script>alert('No esta inscrito en dicha cola.');window.location.href='index.php';</script>";
}

//Cierro la conexion con la BD
mysqli_close(conexion());
?>