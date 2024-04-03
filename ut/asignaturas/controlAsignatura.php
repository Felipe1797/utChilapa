<?php
	include("modelAsignatura.php");
	$asignatura = new modelAsignatura();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$asignatura->cinicial($_POST['vals']);
			break;
		case 'eliminar':
			$asignatura->eliminar($_POST['IdNota'], $_POST['RutaImg']);
			break;
	}
?>
