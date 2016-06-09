<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && ($_SESSION['Rol'] === "administrador" || $_SESSION['Rol'] === "profesor")) {
    
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
                                    <li class="tipo2 item-first_level">
                                        <?php if($_SESSION['Rol']==='administrador'){?>
                                        <a href="PaginaAdministrador.php">Inicio</a>
                                        <?php } else if($_SESSION['Rol']==='profesor'){?>
                                        <a href="PaginaProfesor.php">Inicio</a>
                                        <?php } ?>
                                    </li>
                                    <li class="tipo2 item-first_level">
                                        <?php if($_SESSION['Rol']==='administrador'){?>
                                        <a href="GestionUsuarioAdministrador.php">Gesti&oacute;n de usuarios</a>
                                        <?php } else if($_SESSION['Rol']==='profesor'){?>
                                        <a href="GestionUsuarioProfesor.php">Gestionar mi usuario</a>
                                        <?php } ?>
                                    </li>
                                    <li class="tipo2 item-first_level">
                                    <?php if($_SESSION['Rol']==='administrador'){?>
                                        <a href="GestionColasAdministrador.php">Gesti&oacute;n de colas</a>
                                        <?php } else if($_SESSION['Rol']==='profesor'){?>
                                        <a href="GestionColasProfesor.php">Gestionar mis colas</a>
                                        <?php } ?>
                                    </li>
                                    <?php if($_SESSION['Rol']==='profesor'){ ?>
                                        <li class="tipo2 item-first_level"><a href="GestionTurnos.php">Gesti&oacute;n de Turnos</a></li>
                                    <?php }?>
                                    <li class=" selected tipo2-selected item-first_level"><a href="CrearAviso.php">Crear aviso</a></li>
                                    <li class="tipo2 item-first_level"><a href="CerrarSesion.php">Cerrar Sesi&oacute;n</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="pagina">
                            <h1 id="titulo_pagina"><span class="texto_titulo">Crear aviso</span></h1>
                            <div style="text-align:center">
                                <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "root";
                                $dbname = "gestor_turnos";
                                // Create connection
                                $con = new mysqli($servername, $username, $password, $dbname);
                                // Check connection
                                if ($con->connect_error) {
                                    die("Connection failed: " . $con->connect_error);
                                }
                                $email = $nombre = $apellidos = $dni = "";

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $profesor = $_SESSION['Email'];
                                    $fecha = $_POST['fecha'];
                                    $mensaje = $_POST['mensaje'];
                                    $sql = "INSERT INTO mensajes (Profesor, Fecha, Mensaje) 
                                            VALUES ('$profesor', '$fecha','$mensaje')";

                                    if ($con->query($sql) === TRUE) {
                                        ?>

                                        <script>
                                            alert("El aviso se ha creado correctamente");
                                            window.location = "GestionColasAdministrador.php";
                                        </script>
                                        <?php
                                    } else {
                                        ?>
                                        <script>
                                            alert("Los datos introducidos son erronesos:\n"
                                                    + "\tEl formato de la fecha es: YYYY-MM-DD HH-MM-SS\n"
                                                    + "\tEl campo profesor no puede estar vacio\n");
                                            window.location = "GestionColasAdministrador.php";
                                        </script>
                                        <?php
                                    }
                                }
                                ?>
                                <form id="identif" style="text-align:center" method="post" onsubmit="return validateAltaProfesor()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  >
                                    <table style="width:100%; margin:1px;" align="center" cellpadding="4" cellspacing="4"  >
                                        <tbody><tr> 
                                                <td><div style="font-size: 18px; color:  #243349;" align="center"><b>Crear aviso</b></div></td>
                                            </tr>
                                            <tr align="center"> 
                                                <td> 
                                                    <table class="formulario-datos"  cellpadding="9" cellspacing="6" align="center" >
                                                        <tbody>
                                                            <tr>
                                                                
                                                                    <?php
                                                                    if ($_SESSION['Rol'] === "administrador") {
                                                                    ?>
                                                                <td style="text-align: right;"> Nombre: </td>
                                                                <td>
                                                                        <form  method="post" >
                                                                        <select name="profesor" style="width:100px;" onchange="this.style.width=200">
                                                                            <option value="0" ></option>
                                                                            <?php
                                                                            echo $op=$_SESSION['Rol']; 
                                                                            
                                                                            $profesor = "profesor";
                                                                            $sql = "SELECT * FROM `usuarios`";
                                                                            $result1 = mysqli_query($con, $sql);

                                                                            if ($result1->num_rows > 0) {
                                                                                while ($row1 = mysqli_fetch_array($result1)) {
                                                                                    ?>
                                                                                    <option  value="<?php echo $row1['Email'] ?>"><?php echo $row1['Nombre'] ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            
                                                                            ?>
                                                                        </select>
                                                                    </form>
                                                                        <?php
                                                                        }else{ $b=$_SESSION['nombre'];?>
                                                                        <td style="text-align: right;"> Nombre: </td>
                                                                        <td> <input type="text" name="profesor" value="<?php echo  $b   ?>" /><br/></td>
                                                                    <?php
                                                                    }?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;"> Fecha de expiraci&oacute;n: </td>
                                                                <td> <input type="text" name="fecha" /><br></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;"> Aviso: </td>
                                                                <td><textarea name="mensaje" rows="5" cols="40" maxlength="250"></textarea>  <br></td>

                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td style="text-align: left;"> M&aacute;ximo 250 caracteres </td>  
                                                            </tr>

                                                            <tr> 
                                                                <td colspan="2" style="text-align:center;"><input name="enviar" value="Registrar" class="submit" type="submit"></td>
                                                            </tr>
                                                        </tbody></table> 
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



