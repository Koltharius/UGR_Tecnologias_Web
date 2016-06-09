<?php

session_start();
?>

<?php

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

$user = $_POST['user'];
$passwd = md5($_POST['passwd']);

//Genero la consulta para saber si el usuario está activo
$sql = "SELECT * FROM usuarios WHERE Email='$user'";

//Envio la consulta a MySQL.
$resultado = $con->query($sql);

if ($resultado->num_rows === 1) {
    $row = $resultado->fetch_array(MYSQLI_ASSOC);
    
    $_SESSION['Rol'] = $row['Rol'];

    $profesor = "profesor";
    $administrador = "administrador";
    if ($passwd === $row['Password']) {
        $_SESSION['email'] = $user;
        $_SESSION['nombre'] = $row['Nombre'];
        $_SESSION['loggedin'] = true;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);
        if ($_SESSION['Rol'] === $profesor) {
            echo '<script>window.location.href="PaginaProfesor.php";</script>';
        } else if ($_SESSION['Rol'] === $administrador) {
            echo '<script>window.location.href="PaginaAdministrador.php";</script>';
        }
    }
} else {
    echo "<script>alert('Error en la identificación.');window.location.href='index.php';</script>";
}

mysqli_close($con);
?>