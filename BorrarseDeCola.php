<?php 
session_start(); 
require './ConexionBD.php';
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
                                        <li class="selected tipo1-selected item-second_level first-child"><a href="BorrarseDeCola.php">Darme de Baja</a></li>
                                    </ul>
                                    <li class="tipo2 item-first_level"><a href="CerrarSesion.php">Salir</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <!--Se le permite al usuario darse de baja de la cola 
                        en la que esta inscrito si este lo desea. 
                        Para ello se le presentan los datos que introdujo 
                        al darse de alta en esta y un boton para borrarse.
                        El usuario se borra de la BD-->
                        
                        <div id="pagina">
                            <h1 id="titulo_pagina"><span class="texto_titulo">Darse de Baja</span></h1>
                            <div style="text-align:center">
                                <?php
                                $codigo_alumno = $_SESSION['Codigo_Alumno'];
                                $sql = "SELECT * FROM `alumno` where Codigo_Alumno='$codigo_alumno'";
                                $result = mysqli_query(conexion(), $sql);

                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <form id="identif" style="text-align:center" method="post" onsubmit="return borrarAlumno()" action="BorrarAlumno.php">
                                            <table style="width:100%; margin:1px;" align="center" cellpadding="4" cellspacing="4">
                                                <tbody><tr> 
                                                        <td><div style="font-size: 18px; color:  #243349;" align="center"><b>Borrarse de la Revision</b></div></td>
                                                    </tr>
                                                    <tr align="center"> 
                                                        <td> 
                                                            <table class="formulario-datos"  cellpadding="9" cellspacing="6" align="center" >
                                                                <tbody>


                                                                    <tr> <tr>
                                                                            <td style="text-align: right;"> Nombre: </td>
                                                                            <td> <input type="text" name="nombre" value="<?php echo $row['Nombre'] ?>" readonly="readonly"/><br></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: right;"> Apellidos: </td>
                                                                            <td><input type="text" name="apellidos" value="<?php echo $row['Apellidos'] ?> " readonly="readonly"/><br></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: right;"> DNI: </td>
                                                                            <td><input type="date" name="dni" value="<?php echo $row['DNI'] ?>" readonly="readonly"/><br></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: right;"> Correo electr&oacute;nico: </td>
                                                                            <td><input type="time" name="correo" value="<?php echo $row['Email'] ?>" readonly="readonly"/><br></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: right;"> C&oacute;digo de Revisi&oacute;n: </td>
                                                                            <td><input type="time" name="horaRevision" value="<?php echo $_SESSION['Codigo_Revision'] ?>" readonly="readonly"/><br></td>
                                                                        </tr>
                                                                        <td colspan="2" style="text-align:center;"><input name="enviar" value="Borrar" class="submit" type="submit"></input></td>
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
                                }
                                //Cierro la conexion con la BD
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