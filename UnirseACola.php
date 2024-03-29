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

        <!--Guardamos en la BD los datos introducidos por el usuario en el formulario-->

        <?php
        $codigoRevision = $_SESSION['codigo'];
        $email = $nombre = $apellidos = $dni = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sql1 = "SELECT * FROM `alumno` where codigo_revision='$codigoRevision'";
            $resultado = mysqli_query(conexion(), $sql1);
            $numeroUsuarios = $resultado->num_rows;
            $numeroUsuarios+=1;
            $email = $_POST['email'];
            $nombre = $_POST['nombre'];
            $apellido1 = $_POST['apellido1'];
            $apellido2 = $_POST['apellido2'];
            $apellidos = $apellido1 . " " . $apellido2;
            $dni = $_POST['dni'];
                        
            //Generacion del codigo de alumno cogiendo las tres primeras letras del nombre y las 4 ultimas del dni y las 3 primeras del cod de revision
            $codigoAlumno = substr($nombre, 0, 3) . substr($dni, 5, 4) . substr($codigoRevision, 0, 3);
            

            $sql = "INSERT INTO alumno (DNI, Email, Nombre, Apellidos, Codigo_Alumno, Codigo_Revision, Posicion)
                                    VALUES ('$dni','$email','$nombre', '$apellidos','$codigoAlumno' ,'$codigoRevision','$numeroUsuarios' )";

            if (conexion()->query($sql) === TRUE) {
                ?>

                <!--Se muestra por pantalla al usuario el código de alumno que se ha generado al unirse-->
                <!--Este código debe guardarlo por que lo necesitará para hacer login y ver su posicion-->
                <!--En el caso en el que el usuario ya se haya unido con anterioridad a dicha cola se le indicara-->

                <script>
                    alert("Tu c\u00f3digo asociado a la cola es: <?php echo $codigoAlumno ?> \n El usuario se ha añadido correctamente a esta revisión")
                    window.location.href = "index.php";
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("El usuario ya esta unido a esta revisión");
                </script>
                <?php
            }
            ?>

            <!--Cierre de la conexión con la BD-->
            <?php
            conexion()->close();
        }
        ?>
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
                                    <li class="selected tipo2-selected item-first_level"><a href="UnirseACola.php">Unirse a Cola</a></li>
                                    <li class="tipo2 item-first_level"><a href="PosicionCola.php">Ver Posici&oacute;n</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="pagina">

                            <!--formulario para unirse a la cola-->

                            <h1 id="titulo_pagina"><span class="texto_titulo">Unirse a cola</span></h1>
                            <div style="text-align:center">
                                <form id="identif" style="text-align:center" method="post" onsubmit="return validarDatosRellenos()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  >
                                    <table style="width:100%; margin:1px;" align="center" cellpadding="4" cellspacing="4"  >
                                        <tbody><tr> 
                                                <td><div style="font-size: 18px; color:  #243349;" align="center"><b>Introducir datos del alumno</b></div></td>
                                            </tr>
                                            <tr align="center"> 
                                                <td> 
                                                    <table class="formulario-datos"  cellpadding="9" cellspacing="6" align="center" >
                                                        <tbody>
                                                            <tr>
                                                                <td style="text-align: right;"> Nombre: </td>
                                                                <td> <input type="text" name="nombre" /><br></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;"> Primer apellido: </td>
                                                                <td><input type="text" name="apellido1"/><br></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;"> Segundo apellido: </td>
                                                                <td><input type="text" name="apellido2"/><br></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;"> DNI: </td>
                                                                <td><input type="text" name="dni" maxlength="9"/><br></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;"> Correo electrónico: </td>
                                                                <td><input type="email" name="email"/><br></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: right;"> C&oacute;digo revisi&oacute;n: </td>
                                                                <td><input type="text" name="codigo_revison" value="<?php echo $codigoRevision ?>" readonly="readonly"/><br></td>
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
