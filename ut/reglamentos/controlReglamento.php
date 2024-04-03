<?php
	include("modelReglamento.php");
	$reglamento = new modelReglamento();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$reglamento->cinicial($_POST['vals']);
			break;
		case 'eliminar':
			$reglamento->eliminar($_POST['IdNota'], $_POST['RutaImg']);
			break;
	}
?>
