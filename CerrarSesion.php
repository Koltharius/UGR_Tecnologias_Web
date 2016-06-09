<?php	 
	session_start();
	unset ($_SESSION['email']);
	session_destroy();
	echo '<script>alert("Su sesion se ha cerrado con \u00e9xito");window.location.href="index.php";</script>';	 
?>

