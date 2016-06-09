<?php
session_start();
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

            <!-- funcion para evitar el envio de formularios al pulsar la tecla enter -->
            <script language=javascript type=text/javascript>
                function stopRKey(evt) {
                    var evt = (evt) ? evt : ((event) ? event : null);
                    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
                    if ((evt.keyCode == 13) && (node.type == "text")) {
                        return false;
                    }
                }
                document.onkeypress = stopRKey;
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
                            $alumnos = "SELECT * FROM `alumno`";
                            $resultado = $conn->query($alumnos);

                            if ($resultado->num_rows > 0) {
                                ?>
                                <table class="sec_interior " style="width: 100%; align: center;">
                                    <tbody>          
                                        <tr>
                                            <th class="leftalign">Alumno</th>
                                            <th class="leftalign">Lugar</th>
                                            <th class="leftalign">Estado</th>
                                            <?php
                                            while ($row = mysqli_fetch_array($resultado)) {
                                            $codigo_revision = $row['Codigo_Revision'];
                                            ?>
                                            </tr>
                                            <tr>
                                                <td><?php echo $row['Codigo_Alumno']; ?></td>
                                                <td width="70%"><?php echo $row['Estado'] ?></td>
                                                <td width="70%"><?php echo $row['Estado'] ?></td>
                                            </tr>
                                        <?php } ?>
                                </table>
                                <?php
                            } else {
                                echo "0 results";
                            }
                            ?>                      
                           
                            <?php
                            $sql = "SELECT * FROM `revisiones` WHERE codigo_revision ='$codigo_revision'";
                            $resultado3 = $conn->query($sql);

                            if ($resultado3->num_rows > 0) {
                                while ($row = mysqli_fetch_array($resultado)) {
                                    echo $row['lugar'];
                            }
                            } else {
                                echo "0 results";
                            }
                            ?>



                        </div>
                    </div>


                    <!--                    
                            avisos-->
                    <div id="tabs" class="sec_interior" style="float: center; width: 75%; margin:20px">
                        <div class="content_doku" style="text-align:center;">
                            <?php
                            $mensajes = "SELECT * FROM `mensajes`";

                            $resultado2 = $conn->query($mensajes);

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
                                echo "0 results";
                            }
                            $conn->close();
                            ?>                      
                            </tbody>    



                        </div>
                    </div>
                </div>  <!--fin de MarcoTab-->
                <div id="rightside" style="float:right; width:20%; margin-right:10px;">

                </div>
                <br />
            </div> <!-- Cierra contentwide -->
            <!-- min-heiht hack END -->
            <div class="clear"></div>
            <table class="simple2" cellpadding="2" cellspacing="2" style="width:100%; font-size: x-small; color: #555; border-collapse: collapse; align:center; border-top-width:8px; border-top: solid; border-top-color:#98c6c1; height: 20px; margin: 5px auto 0px auto;" align="center"><tbody>
                    <tr><td style="text-align: center">DECSAI - Departamento de Ciencias de la Computación e Inteligencia Artificial - Acceso Identificado</td></tr>
                </tbody></table>
        </div>
    </body>
</html>


