<?php
//Se destruye la sesion y se cierra la sesión redirigiendo al 
//usuario a la pagina de inicio
session_start();
session_destroy();
echo '<script>alert("Su sesion se ha cerrado con \u00e9xito");window.location.href="index.php";</script>';
?>

