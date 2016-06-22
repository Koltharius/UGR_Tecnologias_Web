<?php
session_start();
require './ConexionBD.php';
//Compruebo que el usuario esta logueado y que su sesion no ha expirado.
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
} else {
    echo "<script>alert('Su sesion ha caducado.');window.location.href='index.php';</script>";
    exit;
}

$now = time();

if ($now > $_SESSION['expire']) {
    session_destroy();
    echo "<script>alert('Su sesion ha expirado.');window.location.href='index.php';</script>";
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

                <div>
                    <div id="general">

                        <!--Menu Lateral-->

                        <div id="menus">
                            <div id="enlaces_secciones" class="mod-menu_secciones">
                                <ul>
                                    <li class="selected tipo2-selected item-first_level"><a href="VerMiPosicion.php">Mis datos en la cola</a></li>
                                    <ul>
                                        <li class="tipo1 item-second_level first-child"><a href="BorrarseDeCola.php">Darme de Baja</a></li>
                                    </ul>
                                    <li class="tipo2 item-first_level"><a href="CerrarSesion.php">Salir</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--Aquí se le brindara al usuario la posición en la que se 
                        encuentra en la cola así como la información relativa 
                        a la cola a la que está inscrito.
                        Se le dara la opción al usuario de borrarse de la cola 
                        en el caso de que el usuario lo desee-->

                        <div id="pagina">
                            <h1 id="titulo_pagina"><span class="texto_titulo">Gestión de usuarios</span></h1>
                            <div id="contenido" class="sec_interior">
                                <div class="content_doku" style="text-align:center">
                                    <?php
                                    $codigo_alumno=$_SESSION['Codigo_Alumno'];
                                    $codigo_revision=$_SESSION['Codigo_Revision'];
                                    $sql = "SELECT * FROM `alumno` where Codigo_Alumno='$codigo_alumno'";
                                    $result = mysqli_query(conexion(), $sql);

                                    $sql1 = "SELECT * FROM `revisiones` where Codigo_Revision='$codigo_revision'";
                                    $result1 = mysqli_query(conexion(), $sql1);

                                    // Tabla de información relativa al alumno
                                    if ($result->num_rows == 1) {
                                        ?>
                                        <table class="sec_interior " style="width: 99%">
                                            <tbody>          
                                                <tr>
                                                    <th class="leftalign">Nombre</th>            
                                                    <th class="leftalign">Apellidos</th>
                                                    <th class="leftalign">DNI</th>
                                                    <th class="leftalign">Codigo Alumno</th>
                                                    <th class="leftalign">Email</th>            
                                                    <th class="leftalign">Posicion Relativa</th>
                                                </tr>
                                                <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                    <tr>
                                                        <td> <?php echo $row['Nombre'] ?> </td>
                                                        <td> <?php echo $row['Apellidos'] ?> </td>
                                                        <td> <?php echo $row['DNI'] ?> </td>
                                                        <td> <?php echo $row['Codigo_Alumno'] ?> </td>
                                                        <td> <?php echo $row['Email'] ?> </td>
                                                        <td> 
                                                            <?php
                                                            if ($row['Posicion'] > 1) {
                                                                echo "Quedan " . abs(1 - $row['Posicion']) . " Personas";
                                                            } elseif ($row['Posicion'] == 1) {
                                                                echo "Es el siguiente.";
                                                            }
                                                            ?> 
                                                        </td>
                                                    </tr>

                                                <?php } ?>
                                        </table>

                                        <?php
                                    }

                                    // Tabla de información relativa a la cola en la que el alumno esta inscrito
                                    if ($result1->num_rows == 1) {
                                        ?>
                                        <table class="sec_interior " style="width: 99%">
                                            <tbody>          
                                                <tr>
                                                    <th class="leftalign">C&oacute;digo</th>            
                                                    <th class="leftalign">Asignatura</th>
                                                    <th class="leftalign">Fecha</th>
                                                    <th class="leftalign">Hora</th>
                                                    <th class="leftalign">Lugar</th>
                                                    <?php
                                                    while ($row = mysqli_fetch_array($result1)) {
                                                        ?>
                                                    </tr>
                                                    <tr>
                                                        <td> <?php echo $row['codigo_revision'] ?> </td>
                                                        <td> <?php echo $row['Asignatura'] ?> </td>
                                                        <td> <?php echo $row['Fecha'] ?> </td>
                                                        <td> <?php echo $row['Hora'] ?> </td>
                                                        <td> <?php echo $row['Lugar'] ?> </td>
                                                    </tr>
                                                <?php } ?>
                                        </table>

                                        <?php
                                    }

                                    //Cierro la conexion con la BD
                                    mysqli_close(conexion());
                                    ?>
                                    </tbody>
                                </div>
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
