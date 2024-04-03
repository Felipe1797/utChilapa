<?php
	include("modelLogin.php");
	$login = new modelLogin();
	switch($_POST['opcion'])
	{
		case "iniciarSesion":
			$login->iniciarSesion($_POST['nombreusuario'],$_POST['contrasena']);
		
	}
?>
