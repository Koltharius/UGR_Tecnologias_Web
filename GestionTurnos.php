<?php
session_start();

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
        <script type="text/javascript" src="js/funciones.js"></script>
    </head>
    <body>
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
                                                                        <li class="tipo2 item-first_level"><a href="PaginaProfesor.php">Inicio</a></li>  
                                                                        <li class="tipo2 item-first_level"><a href="GestionUsuarioProfesor.php">Gestionar mi usuario</a></li>
                                                                        <li class="selected tipo2-selected item-first_level"><a href="GestionColasProfesor.php">Gestinar mis colas</a></li>
                                                                        <ul>
                                                                            <li class="tipo1 item-second_level first-child"><a href="CrearColaProfesor.php">Crear cola</a></li>
                                                                            <li class="tipo1 item-second_level" onclick="cogerDatos('ModificarColaProfesor.php?codigo=', 'enlace_modificar1')">
                                                                                <a href="ModificarColaProfesor.php?codigo=0" id="enlace_modificar1">Modificar cola</a></li>
                                                                            <li class="tipo1 item-second_level" onclick="cogerDatos('BorrarColaProfesor.php?codigo=', 'enlace_borrar1')">
                                                                                <a href="BorrarColaProfesor.php?codigo=0" id="enlace_borrar1">Borrar cola</a></li>
                                                                            <li class="selected tipo1-selected item-second_level" onclick="cogerDatos('GestionTurnos.php?codigo=', 'enlace_activar')">
                                                                                <a href="GestionTurnos.php?codigo=0" id="enlace_borrar1">Gesti&oacute;n de Turnos</a></li>
                                                                        </ul>
                                                                        <li class="tipo2 item-first_level"><a href="CrearAviso.php">Crear aviso</a></li>
                                                                        <li class="tipo2 item-first_level"><a href="CerrarSesion.php">Cerrar Sesi&oacute;n</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div id="pagina">
                                                                <h1 id="titulo_pagina"><span class="texto_titulo">Activaci&oacute;n de Colas</span></h1>
                                                                <div id="contenido" class="sec_interior">
                                                                    <div class="content_doku" style="text-align:center">
                                                                        <?php
                                                                        $servername = "localhost";
                                                                        $username = "root";
                                                                        $password = "root";
                                                                        $dbname = "gestor_turnos";
                                                                        $codigo = $_GET['codigo'];
                                                                        $posicion = '1';
                                                                        // Create connection
                                                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                                            $estado = "Atendido";

                                                                            $sql = "UPDATE alumno SET Estado='Atendido' WHERE Posicion=$posicion";
                                                                            if ($con->query($sql) === TRUE) {
                                                                                $posicion += 1;
                                                                                ?>

                                                                                <script>
                                                                                    window.location = "GestionTurnos.php?codigo=<?php echo $codigo?>";
                                                                                </script>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <script>
                                                                                    alert("Los datos introducidos son erronesos:\n"
                                                                                            + "\tEl formato de la fecha es: YYYY-MM-DD\n"
                                                                                            + "\tEl formato de la hora es: HH-MM-SS\n");
                                                                                    window.location = "GestionColasProfesor.php";
                                                                                </script>
                                                                                <?php
                                                                            }
                                                                        }

                                                                        // Check connection
                                                                        if (!$con) {
                                                                            die("Connection failed: " . mysqli_error($con));
                                                                        } else
                                                                            $sql = "SELECT * FROM `alumno` where Codigo_Revision='$codigo' AND Posicion='$posicion'";

                                                                        $result = mysqli_query($con, $sql);

                                                                        if ($result->num_rows > 0) {
                                                                            ?>
                                                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                                                                <fieldset>

                                                                                    <legend>Atendiendo</legend>
                                                                                    <table class="sec_interior " style="width: 99%">

                                                                                        <tr>
                                                                                            <th class="leftalign">Nombre</th>            
                                                                                            <th class="leftalign">Apellidos</th>            
                                                                                            <th class="leftalign">DNI</th>
                                                                                            <th class="leftalign">Email</th>
                                                                                            <th class="leftalign">Estado</th>
                                                                                            <?php while ($row = mysqli_fetch_array($result)) { ?>

                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td> <?php echo $row['Nombre'] ?> </td>
                                                                                                <td> <?php echo $row['Apellidos'] ?> </td>
                                                                                                <td> <?php echo $row['DNI'] ?> </td>
                                                                                                <td> <?php echo $row['Email'] ?> </td>
                                                                                                <td> <?php echo $row['Estado'] ?> </td>
                                                                                                <?php
                                                                                            }
                                                                                            ?>
                                                                                        </tr>

                                                                                    </table>
                                                                                </fieldset>
                                                                                
                                                                                
                                                                                <input name="enviar" value="Pasar turno" class="submit" type="submit" ></input>
                                                                                <input name="enviar" value="Espera" class="submit" type="submit" ></input>
                                                                            </form>


                                                                            <?php
                                                                        } else {
                                                                            ?>   

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
                                                                        mysqli_close($con);
                                                                        ?>
                                                                        <input id="activar" class="submit" type="button" 
                                                                               onClick="cogerDatos('ActuvarCola.php?codigo=', 'enlace_activar')" style="display: none"></input>
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
