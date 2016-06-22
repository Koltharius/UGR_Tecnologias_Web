<?php
require './ConexionBD.php';
session_start();
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
                                    <li class="tipo2 item-first_level"><a href="index.php">Inicio</a></li>
                                    <li class="tipo2 item-first_level"><a href="UnirseACola.php">Unirse a Cola</a></li>
                                    <li class="selected tipo2-selected item-first_level"><a href="PosicionCola.php">Ver Posici&oacute;n</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="pagina">
                            
                            <!--Pagina en la que los alumnos inscritos en alguna cola
                            pueden introducir sus datos para hacer loggin y ver 
                            la posición relativa en la que estan
                            
                            LA INFORMACION QUE SE LE SOLICITA AL USUARIO ES EL EMAIL CON EL
                            QUE SE INSCRIBIO COMO USUARIO Y EL CODIGO GENERADO COMO PASSWORD-->
                            
                            <h1 id="titulo_pagina"><span class="texto_titulo">Ver mi Posici&oacute;n</span></h1>
                            <div style="text-align:center">

                                <form id="identif" style="text-align:center" method="post" onsubmit="return loginUsuario()" action="ComprobacionUsuarios.php"  >
                                    <table style="width:100%; margin:1px;" align="center" cellpadding="4" cellspacing="4"  >
                                        <tbody>
                                            <tr> 
                                                <td><div style="font-size: 18px; color:  #243349;" align="center"><b>Introduce tus Datos</b></div></td>
                                            </tr>
                                            <tr align="center"> 
                                                <td> 
                                                    <table class="formulario-datos"  cellpadding="9" cellspacing="6" align="center" >
                                                        <tbody>
                                                            <tr>
                                                                <td style="text-align: right;"> Email: </td>
                                                                <td> <input type="text" name="email" /><br></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;"> C&oacute;digo Usuario: </td>
                                                                <td><input type="password" name="cod_usuario"/><br></td>
                                                            </tr>
                                                            <tr> 
                                                                <td colspan="2" style="text-align:center;">
                                                                    <input name="enviar" value="Ver mi posicion" class="submit" type="submit"></input>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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
