<?php
	include("modelCambiarContrasena.php");
	$cambiarContrasena = new modelCambiarContrasena();
	switch($_POST['opcion'])
	{
		case "cambiarContrasena":
			$cambiarContrasena->cambiarContrasena($_POST['Contrasena'], $_POST['ContrasenaNueva'], $_POST['ConfirContrasenaNueva']);
			break;
	}
?>
