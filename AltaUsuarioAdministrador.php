<?php
	session_start();
        //echo $_SESSION['username']=$_SESSION['email']; 
        
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true  && $_SESSION['Rol'] === "administrador") {
	} else {
	   echo "<script>alert('Esta página es solo para administradores'); window.location.href='index.php';</script>";
	exit;
	}
	
	$now = time();
	 
	if($now > $_SESSION['expire']) {
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
                <?php
                    $email= $nombre = $apellidos = $dni = "";
                    
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                                    $email=$_POST['email'];
                                    $nombre=$_POST['nombre'];
                                    $apellido1 = $_POST['apellido1'];
                                    $apellido2 = $_POST['apellido2'];
                                    $dni = $_POST['dni'];
                                    $apellidos = $apellido1 . " ". $apellido2;
                                    $rol = $_POST['rol'];
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "root";
                                    $dbname = "gestor_turnos";
                                    // Create connection
                                    $conn = new mysqli($servername, $username, $password, $dbname);
                                    // Check connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    } 
                                    echo '';
                                    $sql = "INSERT INTO usuarios (Email, Nombre, Apellidos,DNI,Password, Rol)
                                    VALUES ('$email','$nombre', '$apellidos','$dni', md5('$dni'), '$rol')";

                                    if ($conn->query($sql) === TRUE) {
                                        ?>
                                        
                                        <script>
                                            alert("El usuario se ha añadido correctamente a la base de datos");
                                        </script>
                                    <?php
                                    } else {
                                        ?>
                                        <script>
                                           alert("El usuario ya esta en la base de datos");
                                        </script>
                                    <?php
                    
                                        
                                    }

                                    $conn->close();
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
                            <div style="width: 100%; text-align: right; margin: 0px auto 0px auto;">
      <table align="center" style="width:100%; border:none; border-collapse: none; background-color:none; background: none;" class="tabla_menu">
        <tbody>
          <tr>
            <td width="75%" align="left">
            
                <td style="text-align: right;"><b>Usuario:</b> <?php  echo $_SESSION['nombre'] ?><br><img width="10px" height="10px" src="img/cerrar.png" alt="Cerrar Sesión">&nbsp;<a href="CerrarSesion.php">Cerrar Sesión</a><br>
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
	                        <li class="selected tipo1-selected item-second_level first-child"><a href="AltaUsuarioAdministrador.php">Dar de alta usuario</a></li>
	                        <li class="tipo1 item-second_level"><a href="ModificarProfesorAdministrador.php">Modificar datos profesor</a></li>
	                        <li class="tipo1 item-second_level"><a href="BorrarProfesorAdministrador.php">Borrar datos profesor</a></li>
	                    </ul>
	                  <li class="tipo2 item-first_level"><a href="GestionColasAdministrador.php">Gestión de colas</a></li>
                          <li class="tipo2 item-first_level"><a href="CrearAviso.php">Crear aviso</a></li>
                          <li class="tipo2 item-first_level"><a href="CerrarSesion.php">Cerrar Sesi&oacute;n</a></li>
	              </ul>
              </div>
            </div>
            <div id="pagina">
              <h1 id="titulo_pagina"><span class="texto_titulo">Alta de usuario</span></h1>
              <div style="text-align:center">
                  <form id="identif" style="text-align:center" method="post" onsubmit="return validateAltaProfesor()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  >
                        <table style="width:100%; margin:1px;" align="center" cellpadding="4" cellspacing="4"  >
                              <tbody><tr> 
                                  <td><div style="font-size: 18px; color:  #243349;" align="center"><b>Introducir datos del profesor</b></div></td>
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
                                        <td style="text-align: right;"> Tipo de cuenta: </td>
                                                                <td>
                                                                    <form  method="post">
                                                                        <select name="rol" style="width:110px;" onchange="this.style.width=200">
                                                                            <option value="profesor"> Profesor</option>
                                                                            <option value="administrador">Administrador</option>

                                                                        </select>
                                                                    </form>                                                             

                                                                </td>
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
