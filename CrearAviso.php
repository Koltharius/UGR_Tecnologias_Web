<?php
session_start();
require './ConexionBD.php';

//Compruebo que el usuario esta logueado y que su sesion no ha expirado y que su rol es de administrador
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && ($_SESSION['Rol'] === "administrador" || $_SESSION['Rol'] === "profesor")) {
    
} else {
    echo "<script>alert('No tiene permiso para acceder aqui'); window.location.href='index.php';</script>";
    exit;
}

$now = time();

if ($now > $_SESSION['expire']) {
    session_destroy();
    echo "<script>alert('Su sesion ha terminado'); window.location.href='index.php';</script>";
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
        <script type="text/javascript" src="js/ejercicio.js"></script>

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
                                    <td style="text-align: right;">
                                        <b>Usuario:</b> <?php echo $_SESSION['nombre'] ?><br/>
                                        <img width="10px" height="10px" src="img/cerrar.png" alt="Cerrar Sesión">&nbsp;</img>
                                        <a href="CerrarSesion.php">Cerrar Sesión</a><br/>
                                    </td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div id="general">

                        <!--Menus Lateral-->

                        <div id="menus">
                            <div id="enlaces_secciones" class="mod-menu_secciones">
                                <ul>
                                    <li class="tipo2 item-first_level">
                                        <?php if ($_SESSION['Rol'] === 'administrador') { ?>
                                            <a href="PaginaAdministrador.php">Inicio</a>
                                        <?php } else if ($_SESSION['Rol'] === 'profesor') { ?>
                                            <a href="PaginaProfesor.php">Inicio</a>
                                        <?php } ?>
                                    </li>
                                    <li class="tipo2 item-first_level">
                                        <?php if ($_SESSION['Rol'] === 'administrador') { ?>
                                            <a href="GestionUsuarioAdministrador.php">Gesti&oacute;n de usuarios</a>
                                        <?php } else if ($_SESSION['Rol'] === 'profesor') { ?>
                                            <a href="GestionUsuarioProfesor.php">Gestionar mi usuario</a>
                                        <?php } ?>
                                    </li>
                                    <li class="tipo2 item-first_level">
                                        <?php if ($_SESSION['Rol'] === 'administrador') { ?>
                                            <a href="GestionColasAdministrador.php">Gesti&oacute;n de colas</a>
                                        <?php } else if ($_SESSION['Rol'] === 'profesor') { ?>
                                            <a href="GestionColasProfesor.php">Gestionar mis colas</a>
                                        <?php } ?>
                                    </li>
                                    <li class=" selected tipo2-selected item-first_level"><a href="CrearAviso.php">Crear aviso</a></li>
                                    <li class="tipo2 item-first_level"><a href="CerrarSesion.php">Cerrar Sesi&oacute;n</a></li>
                                </ul>
                            </div>
                        </div>


                        <div id="pagina">
                            <h1 id="titulo_pagina"><span class="texto_titulo">Crear aviso</span></h1>
                            <div style="text-align:center">

                                <!--Se recogen los datos del mensaje que se 
                                desea añadir y se incluye en la BD. Se muestra un mensaje al usuario
                                en caso de que haya exito y en caso de que haya algun problema-->

                                <?php
                                $email = $nombre = $apellidos = $dni = "";

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    echo $profesor = $_POST['profesor'] . " ";
                                    echo $fecha = $_POST['fecha'] . " ";
                                    echo $hora = $_POST['hora'] . " ";
                                    echo $mensaje = $_POST['mensaje'] . " ";
                                    $sql = "INSERT INTO mensajes (Profesor, Fecha, Hora, Mensaje) 
                                            VALUES ('$profesor', '$fecha', '$hora', '$mensaje')";

                                    if (conexion()->query($sql) === TRUE) {
                                        if ($_SESSION['Rol'] === 'administrador') {
                                            ?>
                                            <script>
                                                alert("El aviso se ha creado correctamente");
                                                window.location = "PaginaAdministrador.php";
                                            </script>
                                            <?php
                                        } else if ($_SESSION['Rol'] === 'profesor') {
                                            ?>
                                            <script>
                                                alert("El aviso se ha creado correctamente");
                                                window.location = "PaginaProfesor.php";
                                            </script>
                                            <?php
                                        }
                                    } else {
                                        if ($_SESSION['Rol'] === 'administrador') {
                                            ?>
                                            <script>
                                                alert("Los datos introducidos son erronesos:\n"
                                                        + "\tEl formato de la fecha es: YYYY-MM-DD\n"
                                                        + "\tEl formato de la hora es: HH:MM:SS\n"
                                                        + "\tEl campo profesor no puede estar vacio\n");
                                                window.location = "CrearAviso.php";
                                            </script>
                                            <?php
                                        } else if ($_SESSION['Rol'] === 'profesor') {
                                            ?>
                                            <script>
                                                alert("Los datos introducidos son erronesos:\n"
                                                        + "\tEl formato de la fecha es: YYYY-MM-DD\n"
                                                        + "\tEl formato de la hora es: HH-MM-SS\n");
                                                window.location = "CrearAviso.php";
                                            </script>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <form id="identif" style="text-align:center" method="post" onsubmit="return validarMensajes()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  >
                                    <table style="width:100%; margin:1px;" align="center" cellpadding="4" cellspacing="4"  >
                                        <tbody>
                                            <tr> 
                                                <td>
                                                    <div style="font-size: 18px; color:  #243349;" align="center">
                                                        <b>Crear aviso</b>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr align="center"> 
                                                <td> 
                                                    <table class="formulario-datos"  cellpadding="9" cellspacing="6" align="center" >
                                                        <tbody>
                                                            <tr>

                                                                <?php
                                                                if ($_SESSION['Rol'] === "administrador") {
                                                                    ?>
                                                                    <td style="text-align: right;"> Nombre: </td>
                                                                    <td>
                                                                        <form  method="post" >
                                                                            <select name="profesor" style="width:100px;" onchange="this.style.width = 200">
                                                                                <option value="0" ></option>
                                                                                <?php
                                                                                echo $op = $_SESSION['Rol'];

                                                                                $profesor = "profesor";
                                                                                $sql1 = "SELECT * FROM `usuarios`";
                                                                                $result1 = mysqli_query(conexion(), $sql1);

                                                                                if ($result1->num_rows > 0) {
                                                                                    while ($row1 = mysqli_fetch_array($result1)) {
                                                                                        ?>
                                                                                        <option  name="profesor" value="<?php echo $row1['Email'] ?>"><?php echo $row1['Nombre'] ?></option>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </form>
                                                                        <?php
                                                                    } else if ($_SESSION['Rol'] === "profesor") {
                                                                        ?>
                                                                        <td style="text-align: right;"> Nombre: </td>
                                                                        <td>
                                                                            <form  method="post" >
                                                                                <select name="profesor" style="width:100px;" onchange="this.style.width = 200">
                                                                                    <?php
                                                                                    $profesor = $_SESSION['nombre'];
                                                                                    $sql2 = "SELECT * FROM `usuarios` WHERE `Nombre`='$profesor'";
                                                                                    $result2 = mysqli_query(conexion(), $sql2);

                                                                                    if ($result2->num_rows > 0) {
                                                                                        while ($row2 = mysqli_fetch_array($result2)) {
                                                                                            ?>
                                                                                            <option  value="<?php echo $row2['Email'] ?>"><?php echo $row2['Nombre'] ?></option>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </form>
                                                                        <?php
                                                                        }
                                                                        // Se cierra la conexion con la BD
                                                                        mysqli_close(conexion());
                                                                        ?>
                                                                    </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;"> Fecha de expiraci&oacute;n: </td>
                                                                <td> <input type="date" name="fecha" /><br></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;"> Hora de expiraci&oacute;n: </td>
                                                                <td> <input type="text" name="hora" /><br></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;"> Aviso: </td>
                                                                <td><textarea name="mensaje" rows="5" cols="40" maxlength="250"></textarea> <br></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td style="text-align: left;"> M&aacute;ximo 250 caracteres </td>  
                                                            </tr>

                                                            <tr> 
                                                                <td colspan="2" style="text-align:center;"><input name="enviar" value="Crear" class="submit" type="submit"></input></td>
                                                            </tr>
                                                        </tbody></table> 
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>  
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="interior_pie">
                        <div id="pie">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>




