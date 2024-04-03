<?php
	include("modelRequisitosTitulacion.php");
	$requisitostitulacion = new modelRequisitosTitulacion();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$requisitostitulacion->cinicial($_POST['vals']);
			break;
		case 'eliminar':
			$requisitostitulacion->eliminar($_POST['IdNota'], $_POST['RutaImg']);
			break;
	}
?>
