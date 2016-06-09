<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['Rol'] === 'profesor') {
    
} else {
    echo "<script>alert('Permiso denegado Esta pagina es solo para profesores.');window.location.href='index.php';</script>";
    exit;
}

$now = time();

if ($now > $_SESSION['expire']) {
    session_destroy();
    echo "<script>alert('Su sesion ha terminado.');window.location.href='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es" >
    <head>
        <title>Departamento de Ciencias de la Computación e I.A | Universidad de Granada</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <meta name="description" content="Universidad de Granada - Departamento de Ciencias de la Computación e Inteligencia Artificial CCIA-UGR" />
        <meta name="keywords" content="universidad,granada, Departamento Ciencias de la Computación e Inteligencia Artifical (Docencia Tutorías Asignaturas Profesores)" />
        <meta http-equiv="content-language" name="language" content="es" />
        <meta http-equiv="X-Frame-Options" content="deny" />
        <meta name="verify-v1" content="wzNyCz8sYCNt7F8Bg9GWfznkU43lC9PNaZZAxRzkjJA=" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="decsai.ico" type="image/vnd.microsoft.icon" />
        <link rel="icon" href="decsai.ico" type="image/vnd.microsoft.icon" />
        <link rel="stylesheet" id="css-style" type="text/css" href="css/style-gestionTurnos.css" media="all" />
        <link href="css/style_dock.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/funciones.js"></script>            
    </head>
    <body>
        <div id="contenedor_margenes" class="">
            <div id="contenedor" class="">
                <div id="cabecera" class="">
                    <h1 id="cab_inf">Ciencias de la Computación e Inteligencia Artificial</h1>
                    <div id="formularios">
                        <a href="http://www.ugr.es" id="enlace_ugr">Universidad de Granada</a>
                        <span class="separador_enlaces"> | </span>
                        <div class="depto titulo"><span class="titulo_stack">Departamento</span><a href="index.php" id="enlace_stack">Departamento de Ciencias de la Computación e I.A.</a></div>
                        <span class="separador_enlaces"> | </span>
                    </div>
                </div>
                                                <div style="width: 100%; text-align: right; margin: 0px auto 0px auto;">
                    <table align="center" style="width:100%; border:none; border-collapse: none; background-color:none; background: none;" class="tabla_menu">
                        <tbody>
                            <tr>
                                <td width="75%" align="left">

                                    <td style="text-align: right;"><b>Usuario:</b> <?php echo $_SESSION['nombre'] ?><br><img width="10px" height="10px" src="img/cerrar.png" alt="Cerrar Sesión">&nbsp;<a href="CerrarSesion.php">Cerrar Sesión</a><br>
                                                    </td>
                                                    </tr>
                                                    </tbody>
                                                    </table>
                                                    </div>
                <div>
                    <div id="general">
                        <div id="enlaces_secciones" class="mod-menu_secciones">
                            <div id="menus">
                                <ul>
                                    <li class="tipo2 item-first_level"><a href="PaginaProfesor.php">Inicio</a></li>  
                                    <li class="selected tipo2-selected item-first_level"><a href="GestionUsuarioProfesor.php">Gestionar mi usuario</a></li>
                                    <ul>
                                        <li class="selected tipo1-selected item-second_level first-child" onclick="cogerDatos('ModificarProfesor.php?email=', 'enlace_modificar1')">
                                            <a href="ModificarProfesor.php?email=0" target="_self" id="enlace_modificar1">Modificar mis datos</a></li>
                                    </ul>
                                    <li class="tipo2 item-first_level"><a href="GestionColasProfesor.php">Gestionar mis colas</a></li>
                                    <li class="tipo2 item-first_level"><a href="GestionTurnos.php">Gesti&oacute;n de Turnos</a></li>
                                    <li class="tipo2 item-first_level"><a href="CrearAviso.php">Crear aviso</a></li>
                                    <li class="tipo2 item-first_level"><a href="CerrarSesion.php">Cerrar Sesi&oacute;n</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="pagina">
                            <h1 id="titulo_pagina"><span class="texto_titulo">Modificar profesor</span></h1>
                            <div style="text-align:center">
                                <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "root";
                                $dbname = "gestor_turnos";
                                $emailRecibido = (isset($_GET['email'])) ? $_GET['email'] : " ";
                                // Create connection
                                $con = new mysqli($servername, $username, $password, $dbname);
                                // Check connection
                                if ($con->connect_error) {
                                    die("Connection failed: " . $con->connect_error);
                                }
                                $email = $nombre = $apellidos = $dni = $psw = "";

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                                    $email = $_POST['email'];
                                    $nombre = $_POST['nombre'];
                                    $apellidos = $_POST['apellidos'];
                                    $psw = $_POST['password'];
                                    $rol = $_POST['rol'];
                                    if (empty($psw))
                                        $sql = "UPDATE `usuarios` SET Nombre='$nombre', Apellidos='$apellidos', Email='$email', Rol='$rol' where Email='$email'";
                                    else
                                        $sql = "UPDATE `usuarios` SET Nombre='$nombre', Apellidos='$apellidos', Email='$email',  Password=md5('$psw'), Rol='$rol' where Email='$email'";
                                    if ($con->query($sql) === TRUE) {
                                        ?>

                                        <script>
                                            alert("El usuario se ha actualizado correctamente");
                                            window.location = "GestionUsuarioProfesor.php";
                                        </script>
                                        <?php
                                    } else {
                                        ?>
                                        <script>
                                            alert("El usuario ya esta en la base de datos");
                                            window.location = "GestionUsuarioProfesor.php";
                                        </script>
                                        <?php
                                    }
                                } else {
                                    $sql = "SELECT * FROM `usuarios` where Email='$emailRecibido'";
                                    $result = mysqli_query($con, $sql);
                                }

                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <form id="identif" style="text-align:center"   onsubmit="return validateModificarProfesor()" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                            <table style="width:100%; margin:1px;" align="center" cellpadding="4" cellspacing="4">
                                                <tbody><tr> 
                                                        <td><div style="font-size: 18px; color:  #243349;" align="center"><b>Modificar datos del profesor</b></div></td>
                                                    </tr>
                                                    <tr align="center"> 
                                                        <td> 
                                                            <table class="formulario-datos"  cellpadding="9" cellspacing="6" align="center" >
                                                                <tbody>

                                                                    <tr>
                                                                        <td style="text-align: right;"> Nombre: </td>
                                                                        <td> <input type="text" name="nombre" value="<?php echo $row['Nombre'] ?>"/><br></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: right;"> Apellidos: </td>
                                                                        <td><input type="text" name="apellidos" value="<?php echo $row['Apellidos'] ?>"/><br></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: right;"> Correo electrónico: </td>
                                                                        <td><input type="email" name="email" value="<?php echo $row['Email'] ?>" readonly="readonly"/><br></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: right;"> Tipo de cuenta: </td>
                                                                        <td><input type="text" name="rol" value="<?php echo $row['Rol'] ?>" readonly="readonly"/><br></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: right;"> Contraseña: </td>
                                                                        <td><input type="text" name="password" /><br></td>
                                                                    </tr>
                                                                    <tr> 
                                                                        <td colspan="2" style="text-align:center;"><input name="enviar" value="Modificar" class="submit" type="submit" ></td>
                                                                    </tr>

                                                                </tbody></table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>  
                                        </form>
                                        <?php
                                    }
                                } else {
                                    
                                }
                                mysqli_close($con);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
