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
                                    <li class="tipo2 item-first_level"><a href="index.php">Inicio</a></li>  
                                    <li class="tipo2 item-first_level"><a href="UnirseACola.php">Unirse a Cola</a></li>
                                    <li class="tipo2 item-first_level"><a href="PosicionCola.php">Ver Posici&oacute;n</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="pagina">
                            <h1 id="titulo_pagina"><span class="texto_titulo">Información Cola</span></h1>
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
                                    $sql = "SELECT * FROM `revisiones` where codigo_revision='$_GET[codigo]'";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
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
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $codigo = $row['codigo_revision'];
                                                        $_SESSION['codigo'] = $codigo;
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
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
                                    ?>
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
