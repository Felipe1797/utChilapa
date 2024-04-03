<?php
	include("modelEstadia.php");
	$estadia = new modelEstadia();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$estadia->cinicial($_POST['vals']);
			break;
		case 'eliminar':
			$estadia->eliminar($_POST['IdNota'], $_POST['RutaImg']);
			break;
	}
?>
