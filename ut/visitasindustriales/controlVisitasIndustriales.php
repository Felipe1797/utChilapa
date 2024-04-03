<?php
	include("modelVisitasIndustriales.php");
	$visitasindustriales = new modelVisitasIndustriales();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$visitasindustriales->cinicial($_POST['vals']);
			break;
		case 'eliminar':
			$visitasindustriales->eliminar($_POST['IdNota'], $_POST['RutaImg']);
			break;
	}
?>
