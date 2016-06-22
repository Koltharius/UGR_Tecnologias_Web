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

                        <div id="menus">

                            <!--Menu Lateral-->

                            <div id="enlaces_secciones" class="mod-menu_secciones">
                                <ul>
                                    <li class="selected tipo2-selected item-first_level"><a href="index.php">Inicio</a></li>  
                                </ul>
                            </div>

                            <!--Login Para usuarios registrados (Profesores y Administradores)
                            
                            LA INFORMACION QUE SE LE SOLICITA AL USUARIO ES SU EMAIL 
                            Y SU DNI COMO PASSWORD-->

                            <form class="widget_loginform" action="login.php" method="post" onsubmit="return loginUsuario()">
                                <div id="login_form_widget" class="mod-buttons fieldset login_form login_form_widget">
                                    <label id="login_widget" for="ilogin_widget" class="login login_widget">
                                        <span>Usuario</span>
                                        <input name="user" id="ilogin_widget" value="usuario..." onfocus="javascript:if (this.value = 'usuario...')
                                                    this.value = '';
                                                return true;" type="text" />
                                    </label>
                                    <label id="password_widget" for="ipassword_widget" class="password password_widget">
                                        <span>Contraseña</span>
                                        <input name="passwd" id="ipassword_widget" type="password" />
                                    </label>
                                    <label id="enviar_login_widget" for="submit_login_widget" class="enviar_login enviar_login_widget">
                                        <input src="img/transp.gif" alt="enviar datos de identificación" name="submit" id="submit_login_widget" class="image-enviar" type="image" />
                                    </label>
                                </div>
                            </form>
                        </div>

                        <!--div donde se aloja el contenido-->
                        <div id="pagina">
                            <h1 id="titulo_pagina"><span class="texto_titulo">Inicio</span></h1>
                            <div id="contenido" class="sec_interior">
                                <div class="content_doku" style="text-align:center">

                                    <!--Conexion a la BD donde realizamos una consulta para sacar-->
                                    <!--las colas disponibles a las que un usuario puede apuntarse-->
                                    <!--Para ello el usuario debe hacer click encima de cualquier cola-->
                                    <!--y será redirigido a otra pagina donde vera la informacion de dicha cola.-->
                                    <!--Si hay colas disponibles se mostrarán en una tabla.--> 
                                    <!--En el caso de que no haya se mostrará un mensaje al usuario.-->
                                    <?php
                                    $sql = "SELECT * FROM `revisiones` order by `Fecha`";
                                    $result = conexion()->query($sql);
                                    if ($result->num_rows > 0) {
                                        ?>
                                        <table class="sec_interior " style="width: 99%">
                                            <tbody>          
                                                <tr>
                                                    <th class="leftalign">Asignatura</th>
                                                    <th class="leftalign">Fecha</th>
                                                    <th class="leftalign">Hora</th>
                                                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                    </tr>
                                                    <tr>
                                                        <!--Redireccion a InfoColas enviando el codigo de la cola en la URL-->
                                                        <td> <a href="InfoColas.php?codigo=<?php echo $row['codigo_revision'] ?>"><?php echo $row['Asignatura'] ?> </a> </td>
                                                        <td> <a href="InfoColas.php?codigo=<?php echo $row['codigo_revision'] ?>"> <?php echo $row['Fecha'] ?> </a> </td>
                                                        <td> <a href="InfoColas.php?codigo=<?php echo $row['codigo_revision'] ?>"> <?php echo $row['Hora'] ?> </a></td>
                                                    </tr>
                                                <?php } ?>
                                        </table>
                                        <?php
                                    } else {
                                        echo "No hay colas disponibles en este momento.";
                                    }
                                    ?>

                                    <!--Cierre de la conexión con la BD-->
                                    <?php
                                    conexion()->close();
                                    ?>                      
                                    </tbody>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="interior_pie">
                        <div id="pie"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
