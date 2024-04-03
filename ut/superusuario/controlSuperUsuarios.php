<?php
	include("modelSuperUsuarios.php");
	$superusuarios = new modelSuperUsuarios();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$superusuarios->cinicial($_POST['vals']);
			break;
		case 'eliminar':
			$superusuarios->eliminar($_POST['vals']);
			break;
	}
?>