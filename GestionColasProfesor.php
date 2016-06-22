<?php
session_start();
require './ConexionBD.php';

//Compruebo que el usuario esta logueado y que su sesion no ha expirado y que su rol es de administrador
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['Rol'] === 'profesor') {
    
} else {
    echo "<script>alert('Permiso denegado Esta pagina es solo para profesores.');window.location.href='index.php';</script>";
    exit;
}

$email = $_SESSION['email'];
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
        <script type="text/javascript" src="js/ejercicio.js"></script>
    </head>
    <body>
        <!--Redirección de los botones-->
        <a href="BorrarColaProfesor.php?codigo=0"  target="_self" id="enlace_borrar" style="display:none"></a>
        <a href="ModificarColaProfesor.php?codigo=0"  target="_self" id="enlace_modificar" style="display:none"></a>
        <a href="ActivarCola.php?codigo=0"  target="_self" id="enlace_activar" style="display:none"></a>

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

                                    <td style="text-align: right;"><b>Usuario:
                                        </b> <?php echo $_SESSION['nombre'] ?><br/>
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

                        <!--Menu Lateral-->

                        <div id="menus">
                            <div id="enlaces_secciones" class="mod-menu_secciones">
                                <ul>
                                    <li class="tipo2 item-first_level"><a href="PaginaProfesor.php">Inicio</a></li>  
                                    <li class="tipo2 item-first_level"><a href="GestionUsuarioProfesor.php">Gestionar mi usuario</a></li>
                                    <li class="selected tipo2-selected item-first_level"><a href="GestionColasProfesor.php">Gestionar mis colas</a></li>
                                    <ul>
                                        <li class="tipo1 item-second_level first-child"><a href="CrearColaProfesor.php">Crear cola</a></li>
                                        <li class="tipo1 item-second_level" onclick="cogerDatos('ModificarColaProfesor.php?codigo=', 'enlace_modificar1')">
                                            <a href="ModificarColaProfesor.php?codigo=0" id="enlace_modificar1">Modificar cola</a></li>
                                        <li class="tipo1 item-second_level" onclick="cogerDatos('BorrarColaProfesor.php?codigo=', 'enlace_borrar1')">
                                            <a href="BorrarColaProfesor.php?codigo=0" id="enlace_borrar1">Borrar cola</a></li>
                                        <li class="tipo1 item-second_level" onclick="cogerDatos('ActivarCola.php?codigo=', 'enlace_activar')">
                                            <a href="GestionTurnos.php?codigo=0" id="enlace_borrar1">Gesti&oacute;n de Turnos</a></li>
                                    </ul>
                                    <li class="tipo2 item-first_level"><a href="CrearAviso.php">Crear aviso</a></li>
                                    <li class="tipo2 item-first_level"><a href="CerrarSesion.php">Cerrar Sesi&oacute;n</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--En esta pagina el Profesor podrá seleccionar 
                        cualquiera sus colas existentes en el sistema 
                        para borrarla, modificarla o activarla. Para ello deberá de pinchar
                        sobre alguna de las colas que aparecen en la tabla y se 
                        activarán tres botones que corresponderan uno a cada una de las
                        funciones citadas. También podrá seleccionar si desea añadir una
                        cola nueva al sistema para alguna cola nueva.-->

                        <div id="pagina">
                            <h1 id="titulo_pagina"><span class="texto_titulo">Gesti&oacute;n de colas</span></h1>
                            <div id="contenido" class="sec_interior">
                                <div class="content_doku" style="text-align:center">
                                    <?php
                                    $profesor = $_SESSION['email'];
                                    //Con esta consulta se sacan todas las colas del profesor del sistema
                                    //y se presentan en una tabla con sus datos ordenados por fecha.
                                    $sql = "SELECT * FROM `revisiones` where Profesor='$profesor' order by `Fecha`";
                                    $result = mysqli_query(conexion(), $sql);

                                    if ($result->num_rows > 0) {
                                        ?>
                                        <form method="post" onsubmit="return cogerDatos()" action="BorrarColaProfesor.php">
                                            <table class="sec_interior " style="width: 99%">
                                                <tbody>          
                                                    <tr>
                                                        <th class="leftalign">Código revisión</th>            
                                                        <th class="leftalign">Asignatura</th>            
                                                        <th class="leftalign">Fecha</th>
                                                        <th class="leftalign">Hora</th>
                                                        <th class="leftalign">Lugar</th>
                                                        <th class="leftalign">Profesor</th> 

                                                        <?php
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            $email = $row['Profesor'];
                                                            $nombre = "SELECT Nombre FROM `usuarios` where Email='$email'";
                                                            $resultado = mysqli_query(conexion(), $nombre);
                                                            $row1 = mysqli_fetch_array($resultado)
                                                            ?>

                                                        </tr>
                                                        <tr id="<?php echo $row['codigo_revision'] ?> " onclick=" var hora = document.getElementById('<?php echo $row['codigo_revision'] ?> ').getElementsByTagName('td')[3].innerHTML;
                                                                var fecha = document.getElementById('<?php echo $row['codigo_revision'] ?> ').getElementsByTagName('td')[2].innerHTML;
                                                                comprobarFecha(hora, fecha);
                                                                obtenerID(id);
                                                                habilitarBotones();">
                                                            <td > <?php echo $row['codigo_revision'] ?> </td>
                                                            <td> <?php echo $row['Asignatura'] ?> </td>
                                                            <td > <?php echo $row['Fecha'] ?> </td>
                                                            <td > <?php echo $row['Hora'] ?> </td>
                                                            <td> <?php echo $row['Lugar'] ?> </td>
                                                            <td> <?php echo $row1['Nombre'] ?> </td>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                        <?php
                                    } else {
                                        ?>   
                                        <!--En caso de que no haya colas en el sistema la tabla se mostrará vacía-->
                                        <table class="sec_interior " style="width: 99%">
                                            <tbody>          
                                                <th class="centeralign">Selección</th>
                                                <th class="centeralign">Código revisión</th>            
                                                <th class="leftalign">Asignatura</th>            
                                                <th class="leftalign">Fecha</th>
                                                <th class="leftalign">Hora</th>
                                                <th class="leftalign">Lugar</th>   
                                                <tr>
                                                    <td>  </td>
                                                    <td>  </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                </tr>

                                        </table>

                                        <?php
                                    }
                                    //Se cierra la conexion con la base de datos
                                    mysqli_close(conexion());
                                    ?>
                                    <input id="modificar" class="submit" type="button" value="Modificar" 
                                           onClick="cogerDatos('ModificarColaProfesor.php?codigo=', 'enlace_modificar')" style="display: none"></input>

                                    <!--Botones que se activan cuando seleccionas una cola de la tabla.-->
                                    <input id="activar" class="submit" type="button" value="Activar" 
                                           onClick=" cogerDatos('ActivarCola.php?codigo=', 'enlace_activar')" style="display: none"></input>
                                    <input id="borrar" class="submit" type="button" value="Borrar" 
                                           style="display: none" onclick="cogerDatos('BorrarColaProfesor.php?codigo=', 'enlace_borrar')"> </input>
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
