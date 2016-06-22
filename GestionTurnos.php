<?php
session_start();
require './ConexionBD.php';
include('funciones.php');
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['Rol'] === 'profesor') {
    
} else {
    echo "<script>alert('Permiso denegado Esta pagina es solo para profesores.');window.location.href='index.php';</script>";
    exit;
}
$codigo = $_SESSION['codigo'];
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

                        <!--Menus Lateral-->

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
                                    $estado_atendido = "Atendido";
                                    $estado_no_atendido = "No atendido";
                                    $estado_esperando = "Esperando";
                                    $vector_espera = Array();
                                    $codigo;
                                    $posicion = 1;
                                    
                                    $posicion = (isset($_SESSION['posicion'])) ? $_SESSION['posicion'] : 1;

                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        //Creamos una estructura if else para según que boton pulsemos haremos una cosa u otra
                                        if (!empty($_POST['pasarTurno'])) {
                                            //Actualizamos el estado del alumno a atendido
                                            $sql = "UPDATE alumno SET Estado='$estado_atendido' WHERE Codigo_Revision='$codigo' AND Posicion='$posicion'";
                                            
                                            if (conexion()->query($sql) === TRUE) {
                                                $arrlength = count($vector_espera);
                                                //Si en el vector de alumnos en espera no hay alumnos pasamos
                                                //a la siguiente posición
                                                if ($arrlength == 0) {
                                                    $posicion+=1;
                                                //En el caso de que tengamos alumnos en espera cargamos en posición 
                                                //la posición del a lumno en espera
                                                } else if (0 < $arrlength) {
                                                    $posicion = array_shift($vector_espera);
                                                } else {

                                                    $posicion+=1;
                                                }
                                                //grabamos la nueva posición en una variable de sesión
                                                $_SESSION['posicion'] = $posicion;
                                                ?>
                                                <script>
                                                    window.location = "GestionTurnos.php";
                                                </script>
                                                <?php
                                            } else {
                                                ?>
                                                <script>
                                                    alert("error");
                                                    window.location = "GestionTurnos.php";
                                                </script>
                                                <?php
                                            }
                                        } else if (!empty($_POST['esperar'])) {
                                            //Si hemos seleccionado el boton espera, actualizamos el estado del 
                                            //alumno a esperando
                                            $sql = "UPDATE alumno SET Estado='$estado_esperando' WHERE Codigo_Revision='$codigo' AND Posicion='$posicion'";

                                            if (conexion()->query($sql) === TRUE) {
//                                                //Grabadmos la posición del alumno en espera en una variable                      
                                                $posicion = (isset($_SESSION['posicion'])) ? $_SESSION['posicion']: 1;
                                                //Grabamos la posición del alumno en espera en el vector de espera 
                                                $vector_espera[] = $posicion;
                                                //Pasamos por una varible de session el vector
                                                $_SESSION['vector_espera'] = $vector_espera;
                                                //Aumentamos en uno la posicion para que llame al siguiente alumno
                                                $posicion+=1;
                                                //grabamos la nueva posición en una variable de sesión
                                                $_SESSION['posicion'] = $posicion;
                                                ?>
                                                <script>
                                                    window.location = "GestionTurnos.php";
                                                </script>

                                                <?php
                                            } else {
                                                ?>
                                                <script>
                                                    alert("error");
                                                    window.location = "GestionTurnos.php";
                                                </script>
                                                <?php
                                            }
                                        }
                                    }

// Check connection
                                    if (!conexion()) {
                                        die("Connection failed: " . mysqli_error(conexion()));
                                    } else {
                                        //Muetra el alumno que este con estado no atendido o esperando y que coincida con la posición almacenada
                                        $sql = "SELECT * FROM `alumno` where Codigo_Revision='$codigo' AND (Estado='$estado_no_atendido' OR Estado='$estado_esperando') AND Posicion='$posicion'";
                                    }
                                    $result = mysqli_query(conexion(), $sql);

                                    if ($result->num_rows > 0) {
                                        ?>
                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                            <fieldset>

                                                <legend><h2>Atendiendo</h2></legend>
                                                <table class="sec_interior " style="width: 99%">

                                                    <tr>
                                                        <th class="leftalign">Nombre</th>            
                                                        <th class="leftalign">Apellidos</th>            
                                                        <th class="leftalign">DNI</th>
                                                        <th class="leftalign">Email</th>
                                                        <th class="leftalign">Estado</th>
                                                        <?php while ($row = mysqli_fetch_array($result)) {
                                                            ?>

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


                                            <input name="pasarTurno"  class="submit" type="submit" value="Pasar Siguiente"></input>
                                            <input name="esperar"  class="submit" type="submit"  value="Poner a Espera"></input>
                                        </form>


                                        <?php
                                    } else {
                                        //Buscamos todos los alumnos que tiene la revision
                                        $sql2 = "SELECT * FROM `alumno` where Codigo_Revision='$codigo' ";
                                        $result2 = mysqli_query(conexion(), $sql2);
                                        $numeroColumnas = $result2->num_rows;
                                        //Buscamos todos los alumnos que tengan como estado esperando
                                        $sql3 = "SELECT * FROM `alumno` where Codigo_Revision='$codigo'  AND Estado='$estado_esperando'";
                                        $result3 = mysqli_query(conexion(), $sql3);
                                        $numeroColumnas1 = $result3->num_rows;
                                        //comprobamos si hay todavía gente sin atender si es el caso
                                        //llamamos al siguiente
                                        if ($posicion < $numeroColumnas) {
                                            $posicion += 1;
                                            $_SESSION['posicion'] = $posicion;
                                            ?>
                                            <script>
                                                window.location = "GestionTurnos.php";
                                            </script>

                                            <?php
                                           //si hemos llamado a todos loa alumnos al menos una vez y queda gente en espera
                                            //reiniciamos las posiciones
                                        } else if ($posicion >= $numeroColumnas && $numeroColumnas1 > 0) {
                                            $posicion = 1;
                                            $_SESSION['posicion'] = $posicion;
                                            ?>
                                            <script>
                                                window.location = "GestionTurnos.php";
                                            </script>

                                            <?php
                                        } else {
                                            //si hemos terminado de atender los alumnos, borramos las variables
                                            //cargamos el codigo de la revisión y luego la borramos
                                            unset($posicion);
                                            unset($vector_espera);
                                            $codigo = $_SESSION['codigo'];
                                            $sql4 = "DELETE FROM `revisiones` where codigo_revision='$codigo'";
                                            if (conexion()->query($sql4) === TRUE) {
                                                ?>
                                                <script>
                                                    alert("La revisi\u00f3n ha sido eliminada del sistema ");

                                                    window.location = "GestionColasProfesor.php";
                                                </script>
                                                <?php
                                            } else {
                                                ?>
                                                <script>
                                                    alert("La revisi\u00f3n no ha pod\u00eddo ser eliminada del sistema ");

                                                    window.location = "GestionColasProfesor.php";
                                                </script>
                                                <?php
                                            }
                                        }
                                        ?>   
                                        <form>
                                            <fieldset>

                                                <legend  ><h2>Atendiendo</h2></legend>
                                                <table class="sec_interior " style="width: 99%">
                                                    <tbody>          
                                                        <th class="leftalign">Nombre</th>            
                                                        <th class="leftalign">Apellidos</th>            
                                                        <th class="leftalign">DNI</th>
                                                        <th class="leftalign">Email</th>
                                                        <th class="leftalign">Estado</th> 
                                                        <tr>
                                                            <td>  </td>
                                                            <td>  </td>
                                                            <td> </td>
                                                            <td> </td>
                                                            <td> </td>
                                                            <td> </td>
                                                        </tr>

                                                </table>
                                            </fieldset>



                                        </form>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    //Mostramos en una tabla la gente que esta en espera.
                                    if (!conexion()) {
                                        die("Connection failed: " . mysqli_error(conexion()));
                                    } else {
                                        $sql1 = "SELECT * FROM `alumno` where Codigo_Revision='$codigo' AND Estado='$estado_esperando' ORDER BY Posicion";
                                    }
                                    $result1 = mysqli_query(conexion(), $sql1);

                                    if ($result1->num_rows > 0) {
                                        ?>
                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                            <fieldset>

                                                <legend><h2>Esperando</h2></legend>
                                                <table class="sec_interior " style="width: 99%">

                                                    <tr>
                                                        <th class="leftalign">Nombre</th>            
                                                        <th class="leftalign">Apellidos</th>            
                                                        <th class="leftalign">DNI</th>
                                                        <th class="leftalign">Email</th>
                                                        <th class="leftalign">Estado</th>
                                                        <?php while ($row1 = mysqli_fetch_array($result1)) {
                                                            ?>

                                                        </tr>
                                                        <tr>
                                                            <td> <?php echo $row1['Nombre'] ?> </td>
                                                            <td> <?php echo $row1['Apellidos'] ?> </td>
                                                            <td> <?php echo $row1['DNI'] ?> </td>
                                                            <td> <?php echo $row1['Email'] ?> </td>
                                                            <td> <?php echo $row1['Estado'] ?> </td>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tr>

                                                </table>
                                            </fieldset>
                                        </form>


                                        <?php
                                    } else {
                                        ?>   

                                        <form>
                                            <fieldset>

                                                <legend><h2>Esperando</h2></legend>
                                                <table class="sec_interior " style="width: 99%">
                                                    <tbody>          
                                                        <th class="leftalign">Nombre</th>            
                                                        <th class="leftalign">Apellidos</th>            
                                                        <th class="leftalign">DNI</th>
                                                        <th class="leftalign">Email</th>
                                                        <th class="leftalign">Estado</th> 
                                                        <tr>
                                                            <td>  </td>
                                                            <td>  </td>
                                                            <td> </td>
                                                            <td> </td>
                                                            <td> </td>
                                                            <td> </td>
                                                        </tr>

                                                </table>
                                            </fieldset>



                                        </form>

                                        <?php
                                    }
                                    mysqli_close(conexion());
                                    ?>

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
