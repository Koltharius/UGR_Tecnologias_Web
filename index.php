<?php session_start(); ?>
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
                <div>
                    <div id="general">
                        <div id="menus">
                            <div id="enlaces_secciones" class="mod-menu_secciones">
                                <ul>
                                    <li class="selected tipo2-selected item-first_level"><a href="index.php">Inicio</a></li>  
                                </ul>
                            </div>
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
                                    <!--<span id="login_error_widget"> </span>-->
                                </div>
                            </form>
                        </div>

                        <div id="pagina">
                            <h1 id="titulo_pagina"><span class="texto_titulo">Inicio</span></h1>
                            <div id="contenido" class="sec_interior">
                                <div class="content_doku" style="text-align:center">
                                    <?php
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "root";
                                    $dbname = "gestor_turnos";
                                    // Create connection
                                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                                    // Check connection
                                    if (!$conn) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }
                                    $sql = "SELECT * FROM `revisiones` order by `Fecha`";
                                    $result = $conn->query($sql);
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
                                                        <td> <a href="InfoColas.php?codigo=<?php echo $row['codigo_revision'] ?>"><?php echo $row['Asignatura'] ?> </a> </td>
                                                        <td> <a href="InfoColas.php?codigo=<?php echo $row['codigo_revision'] ?>"> <?php echo $row['Fecha'] ?> </a> </td>
                                                        <td> <a href="InfoColas.php?codigo=<?php echo $row['codigo_revision'] ?>"> <?php echo $row['Hora'] ?> </a></td>
                                                    </tr>
                                                <?php } ?>
                                        </table>
                                        <?php
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
                                    ?>                      
                                    </tbody>    



                                </div>
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
