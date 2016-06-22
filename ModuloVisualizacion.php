<?php
session_start();
require './ConexionBD.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es"	>
    <head><meta http-equiv="Content-type" content="text/html;charset=iso-8859-1" />
        <title>
            CCIA. Departamento de Ciencias de la Computación e Inteligencia Artificial          </title>
        <link rel="shortcut icon" href="decsai.ico">
            <meta name="description" content="Página Web del Departamento de Ciencias de la Computación e Inteligencia Artificial CCIA" />
            <meta name="keywords" content="Ciencias de la Computación, Inteligencia Artificial, Informática, Universida de Granada" />
            <meta name="author" content="Pablo Orantes Pozo / Original design by Andreas Viklund - http://andreasviklund.com/" />
            <meta http-equiv="X-Frame-Options" content="deny" />
            <link rel="stylesheet" type="text/css" href="css/style.css" media="screen,projection" />
            <link rel="stylesheet" id="css-style" type="text/css" href="css/style-gestionTurnos.css" media="all" />
            <link href="css/style_dock.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="js/ejercicio.js"></script>

            <script>
<!-- funcion para evitar el envio de formularios al pulsar la tecla enter -->
                function stopRKey(evt) {
                    var evt = (evt) ? evt : ((event) ? event : null);
                    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
                    if ((evt.keyCode == 13) && (node.type == "text")) {
                        return false;
                    }
                }
                document.onkeypress = stopRKey;
                //Función para refrescar la página
                function refresh() {
                    location.reload(true);
                }
                var int = self.setInterval("refresh()", 3000);
            </script>

    </head>

    <body>

        <div style="width: 90%; margin: 0px auto; background-color: #FFF;"> 	
            <table style="width: 100%; margin: 0px auto 5px auto;" class="simple"><tbody>
                    <tr>
                        <td style="text-align: left;"  width="101px"><a href="http://www.ugr.es" title="ir a UGR"><img alt="logo UGR" src="img/logo_ugr.png" /></a></td>
                        <td style="text-align: center;" >
                            <img src="img/departamento.png" alt="Departamento de Ciencias de la Computación e I.A." />
                        </td>
                        <td style="text-align: right;" width="101px"><a title="ir a decsai" href="http://decsai.ugr.es"><img alt="logo decsai" src="img/leon2.png" /></a></td>
                    </tr>
                </tbody></table>


            <div id='contentwide'>
                <h2 align='center'>Modulo Visualizaci&oacute;n</h2>
                <!--<hr style="color: #98C6C1; size: 2px;" />-->            
                <div id="leftside" style="float:left; width: 20%; margin-left: 10px;">
                </div> 

                <div class="MarcoTab" style="float:right; width:75%; margin:0px 20px 10px auto;">
                    <div id="tabs" class="sec_interior" style="float: center; width: 75%; margin:20px">
                        <div class="content_doku" style="text-align:center;">
                            <?php
                            $codigo_revision;
                            $estado_atendido = "Atendido";
                            $estado_esperando = "Esperando";
                            $activado = "Activa";
                            //Buscamos todas las revisiones que esten activas
                            $estado_cola = "SELECT * FROM `revisiones` WHERE Estado='$activado' ";
                            $resultado = conexion()->query($estado_cola);

                            if ($resultado->num_rows > 0) {
                                ?>
                                <table class="sec_interior " style="width: 100%; align: center;">
                                    <tbody>          
                                        <tr>
                                            <th class="leftalign">Alumno</th>
                                            <th class="leftalign">Lugar</th>
                                            <th class="leftalign">Asignatura</th>
                                            <th class="leftalign">Estado</th>
                                            <?php
                                            while ($row = mysqli_fetch_array($resultado)) {
                                                //Por cada revision activa buscamos los alumnos  no atendidos o en espera
                                                //Hasta un máximo de 2 alumnos
                                                $codigo_revision = $row['codigo_revision'];
                                                $alumnos = "SELECT * FROM `alumno` where Codigo_Revision='$codigo_revision' AND Estado='$estado_atendido' ORDER BY Posicion  LIMIT 0, 5  ";
                                                $resultado4 = mysqli_query(conexion(), $alumnos);

                                                if ($resultado4->num_rows > 0) {
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    while ($row1 = mysqli_fetch_array($resultado4)) {
                                                        ?>
                                                        <td width="23%"><?php echo $row1['Codigo_Alumno']; ?></td>
                                                        <td width="23%"><?php echo $row['Lugar'] ?></td>
                                                        <td width="23%"><?php echo $row['Asignatura'] ?></td>
                                                        <td width="23%"><?php echo $row1['Estado'] ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                            } else {
                                                //echo "0 results";
                                            }
                                        }
                                        ?>
                                </table>
                                <?php
                            } else {
                                //echo "0 results";
                            }
                            ?>
                        </div>
                    </div>


                    <!--                    
                            avisos-->
                    <div id="tabs" class="sec_interior" style="float: center; width: 75%; margin:20px">
                        <div class="content_doku" style="text-align:center;">
                            <?php
                            //Buscamos todos los mensajes
                            $mensajes = "SELECT * FROM `mensajes`";

                            $resultado2 = conexion()->query($mensajes);
                            //Mostramos todos los mensajes
                            if ($resultado2->num_rows > 0) {
                                ?>
                                <table class="sec_interior " style="width: 100%; align: center">
                                    <tbody>          
                                        <tr>
                                            <th class="leftalign">Profesor</th>
                                            <th class="leftalign">Mensaje</th>
                                            <?php while ($row = mysqli_fetch_array($resultado2)) { ?>
                                            </tr>
                                            <tr>
                                                <td><?php echo $row['Profesor']; ?></td>
                                                <td width="70%"><?php echo $row['Mensaje'] ?></td>
                                            </tr>
                                        <?php } ?>
                                </table>
                                <?php
                            } else {
//                                echo "0 results";
                            }
                            conexion()->close();
                            ?>                      
                            </tbody>    
                        </div>
                    </div>
                </div>  <!--fin de MarcoTab-->

            </div> <!-- Cierra contentwide -->
            <!-- min-heiht hack END -->
            <div class="clear"></div>
            <table class="simple2" cellpadding="2" cellspacing="2" style="width:100%; font-size: x-small; color: #555; border-collapse: collapse; align:center; border-top-width:8px; border-top: solid; border-top-color:#98c6c1; height: 20px; margin: 5px auto 0px auto;" align="center"><tbody>
                    <tr><td style="text-align: center">DECSAI - Departamento de Ciencias de la Computación e Inteligencia Artificial</td></tr>
                </tbody></table>
        </div>
    </body>
</html>


