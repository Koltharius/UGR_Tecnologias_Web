<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['Rol'] === "administrador") {
    
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
        <script type="text/javascript" src="js/funciones.js"></script>   
    </head>

    <body>
        <a href="BorrarProfesorAdministrador.php?email=0"  target="_self" id="enlace_borrar" style="display:none"></a>
        <a href="ModificarProfesorAdministrador.php?email=0"  target="_self" id="enlace_modificar" style="display:none"></a>
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
                                                                        <li class="tipo2 item-first_level"><a href="PaginaAdministrador.php">Inicio</a></li>  
                                                                        <li class="selected tipo2-selected item-first_level"><a href="GestionUsuarioAdministrador.php">Gestión de usuarios</a></li>
                                                                        <ul>
                                                                            <li class="tipo1 item-second_level first-child"><a href="AltaUsuarioAdministrador.php">Dar de alta usuario</a></li>
                                                                            <li class="tipo1 item-second_level" onclick="cogerDatos('ModificarProfesorAdministrador.php?email=', 'enlace_modificar1')">
                                                                                <a href="ModificarProfesorAdministrador.php?email=0" target="_self" id="enlace_modificar1">Modificar datos profesor</a></li>
                                                                            <li class="tipo1 item-second_level" onclick="cogerDatos('BorrarProfesorAdministrador.php?email=', 'enlace_borrar1')">
                                                                                <a href="BorrarProfesorAdministrador.php?email=0" target="_self" id="enlace_borrar1" >Borrar datos profesor</a></li>
                                                                        </ul>
                                                                        <li class="tipo2 item-first_level"><a href="GestionColasAdministrador.php">Gestión de colas</a></li>
                                                                        <li class="tipo2 item-first_level"><a href="CrearAviso.php">Crear aviso</a></li>
                                                                        <li class="tipo2 item-first_level"><a href="CerrarSesion.php">Cerrar Sesi&oacute;n</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div id="pagina">
                                                                <h1 id="titulo_pagina"><span class="texto_titulo">Gestión de usuarios</span></h1>
                                                                <div id="contenido" class="sec_interior">
                                                                    <div class="content_doku" style="text-align:center">
                                                                        <?php
                                                                        $servername = "localhost";
                                                                        $username = "root";
                                                                        $password = "root";
                                                                        $dbname = "gestor_turnos";
                                                                        // Create connection
                                                                        $con = mysqli_connect($servername, $username, $password, $dbname);
                                                                        // Check connection
                                                                        if (!$con) {
                                                                            die("Connection failed: " . mysqli_error($con));
                                                                        } else
                                                                            $sql = "SELECT * FROM `usuarios`";
                                                                        $result = mysqli_query($con, $sql);

                                                                        if ($result->num_rows > 0) {
                                                                            ?>
                                                                            <table class="sec_interior " style="width: 99%">
                                                                                <tbody>          
                                                                                    <tr>
                                                                                        <th class="leftalign">Nombre</th>            
                                                                                        <th class="leftalign">Apellidos</th>            
                                                                                        <th class="leftalign">Correo eléctronico</th>            
                                                                                        <th class="leftalign">Tipo de cuenta</th>
                                                                                    </tr>
                                                                                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                                                        <tr id="<?php echo $row['Email'] ?>" onclick="obtenerID(id); habilitarBotones();"> 
                                                                                            <td> <?php echo $row['Nombre'] ?> </td>
                                                                                            <td> <?php echo $row['Apellidos'] ?> </td>
                                                                                            <td> <?php echo $row['Email'] ?> </td>
                                                                                            <td> <?php echo $row['Rol'] ?> </td>
                                                                                        </tr>

                                                                                    <?php } ?>
                                                                            </table>

                                                                            <?php
                                                                        } else {
                                                                            ?>   

                                                                            <table class="sec_interior " style="width: 99%">
                                                                                <tbody>          
                                                                                    <tr> 

                                                                                        <th class="centeralign">Nombre</th>            
                                                                                        <th class="leftalign">Apellidos</th>            
                                                                                        <th class="leftalign">Correo eléctronico</th>            

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>  </td>
                                                                                        <td>  </td>
                                                                                        <td> </td>
                                                                                        <td> </td>
                                                                                    </tr>

                                                                            </table>

                                                                            <?php
                                                                        }
                                                                        mysqli_close($con);
                                                                        ?>
                                                                        </tbody>    
                                                                        <input id="borrar" class="submit" type="button" value="Borrar" onclick="cogerDatos('BorrarProfesorAdministrador.php?email=', 'enlace_borrar')"
                                                                               style="display: none"> </input>
                                                                        <input id="modificar" class="submit" type="button" value="Modificar" 
                                                                               onClick="cogerDatos('ModificarProfesorAdministrador.php?email=', 'enlace_modificar')" style="display: none"></input>


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
