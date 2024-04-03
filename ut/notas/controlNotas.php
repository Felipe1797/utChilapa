<?php
	include("modelNotas.php");
	$notas = new modelNotas();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$notas->cinicial($_POST['vals']);
			break;
		case 'eliminar':
			$notas->eliminar($_POST['IdNota'], $_POST['RutaImg']);
			break;
		case 'cinicialpromo':
			$notas->cinicialpromo($_POST['vals']);
			break;
		case 'eliminarpromo':
			$notas->eliminarpromo($_POST['Id'], $_POST['RutaImg']);
			break;
	}
?>
