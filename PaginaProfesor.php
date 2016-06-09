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
                        <div id="menus">
                            <div id="enlaces_secciones" class="mod-menu_secciones">
                                <ul>
                                    <li class="selected tipo2-selected item-first_level"><a href="PaginaProfesor.php">Inicio</a></li>
                                    <li class="tipo2 item-first_level"><a href="GestionUsuarioProfesor.php">Gestionar mi usuario</a></li>
                                    <li class="tipo2 item-first_level"><a href="GestionColasProfesor.php">Gestionar mis colas</a></li>
                                    <li class="tipo2 item-first_level"><a href="GestionTurnos.php">Gesti&oacute;n de Turnos</a></li>
                                    <li class="tipo2 item-first_level"><a href="CrearAviso.php">Crear aviso</a></li>
                                    <li class="tipo2 item-first_level"><a href="CerrarSesion.php">Cerrar Sesi&oacute;n</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="pagina">
                            <h1 id="titulo_pagina"><span class="texto_titulo">Perfil de Profesor</span></h1>
                            <div style="text-align:center">
                                <br /><br />
                                <img title="Departamento de Ciencias de la Computación e Inteligencia Artificial DECSAI" alt="logo" src="img/WebDECSAI.png" />
                                <br /><br />
                            </div>
                        </div>
                    </div>
                    <script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
                    <script type="text/javascript">_uacct = "UA-2290740-1";urchinTracker();</script>

                    <div id="interior_pie">
                        <div id="pie">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
