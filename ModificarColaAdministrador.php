<?php
session_start();
require './ConexionBD.php';

//Compruebo que el usuario esta logueado y que su sesion no ha expirado y que su rol es de administrador
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['Rol'] === 'administrador') {
    
} else {
    echo "<script>alert('Esta página es solo para administradores'); window.location.href='index.php';</script>";
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
                        
                        <!--Menus lateral-->
                        
                        <div id="menus">
                            <div id="enlaces_secciones" class="mod-menu_secciones">
                                <ul>
                                    <li class="tipo2 item-first_level"><a href="PaginaAdministrador.php">Inicio</a></li>  
                                    <li class="tipo2 item-first_level"><a href="GestionUsuarioAdministrador.php">Gestión de usuarios</a></li>
                                    <li class="selected tipo2-selected item-first_level"><a href="GestionColasAdministrador.php">Gestión de colas</a></li>
                                    <ul>
                                        <li class="tipo1 item-second_level first-child"><a href="CrearColaAdministrador.php">Crear cola</a></li>
                                        <li class="selected tipo1-selected item-second_level"><a href="ModificarColaAdministrador.php">Modificar cola</a></li>
                                        <li class="tipo1 item-second_level"><a href="BorrarColaAdministrador.php">Borrar cola</a></li>

                                    </ul>
                                    <li class="tipo2 item-first_level"><a href="CrearAviso.php">Crear aviso</a></li>
                                    <li class="tipo2 item-first_level"><a href="CerrarSesion.php">Cerrar Sesi&oacute;n</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="pagina">
                            <h1 id="titulo_pagina"><span class="texto_titulo">Modificar revisión</span></h1>
                            <div style="text-align:center">

                                <!--Se recogen los datos introducidos en el
                                formulario y se actualizan en la cola correspondiente
                                en la base de datos.-->
                                <?php
                                $codigoRecibido = (isset($_GET['codigo'])) ? $_GET['codigo'] : " ";
                                $email = $nombre = $apellidos = $dni = "";
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $codigo = $_POST['codigo'];
                                    $lugar = $_POST['lugarDeRevision'];
                                    $fecha = $_POST['fechaRevision'];
                                    $hora = $_POST['horaRevision'];
                                    $sql = "UPDATE `revisiones` SET   Lugar='$lugar', Fecha='$fecha', Hora='$hora' where codigo_revision='$codigo'";
                                    if (conexion()->query($sql) === TRUE) {
                                        ?>

                                        <script>
                                            alert("El usuario se ha actualizado correctamente");
                                            window.location = "GestionColasAdministrador.php";
                                        </script>
                                        <?php
                                    } else {
                                        ?>
                                        <script>
                                            alert("Los datos introducidos son erronesos:\n"
                                                    + "\tEl formato de la fecha es: YYYY-MM-DD\n"
                                                    + "\tEl formato de la hora es: HH-MM-SS\n");
                                            window.location = "GestionColasAdministrador.php";
                                        </script>
                                        <?php
                                    }
                                } else {
                                    $sql = "SELECT * FROM `revisiones` where codigo_revision='$codigoRecibido'";
                                    $result = mysqli_query(conexion(), $sql);
                                }

                                //Formulario en el cual se modificaran los datos de la cola seleccionada
                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <form id="identif" style="text-align:center"   onsubmit="return validateFormColas()" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                            <table style="width:100%; margin:1px;" align="center" cellpadding="4" cellspacing="4">
                                                <tbody><tr> 
                                                        <td><div style="font-size: 18px; color:  #243349;" align="center"><b>Modificar datos de la revisión</b></div></td>
                                                    </tr>
                                                    <tr align="center"> 
                                                        <td> 
                                                            <table class="formulario-datos"  cellpadding="9" cellspacing="6" align="center" >
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="text-align: right;"> Codigo: </td>
                                                                        <td> <input type="text" name="codigo" value="<?php echo $row['codigo_revision'] ?>" readonly="readonly"/><br></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: right;"> Asignatura: </td>
                                                                        <td><input type="text" name="asignatura" value="<?php echo $row['Asignatura'] ?> " readonly="readonly"/><br></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: right;"> Lugar de revisión: </td>
                                                                        <td><input type="text" name="lugarDeRevision" value="<?php echo $row['Lugar'] ?>" /><br></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: right;"> Fecha de revisión: </td>
                                                                        <td><input type="date" name="fechaRevision" value="<?php echo $row['Fecha'] ?>" /><br></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: right;"> Hora de revisión: </td>
                                                                        <td><input type="time" name="horaRevision" value="<?php echo $row['Hora'] ?>" /><br></td>
                                                                    </tr>
                                                                    <tr> 
                                                                        <td colspan="2" style="text-align:center;"><input name="enviar" value="Modificar" class="submit" type="submit" ></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>  
                                        </form>
                                        <?php
                                    }
                                } else {
                                    
                                }
                                // Cierre de la conexion con la BD
                                mysqli_close(conexion());
                                ?>
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
