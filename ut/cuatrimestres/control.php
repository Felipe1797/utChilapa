<?php
	include("model.php");
	$cuatrimestre = new model();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$cuatrimestre->cinicial($_POST['vals']);
			break;
		case 'agregar':
			$cuatrimestre->agregar($_POST['Cuatrimestre'],$_POST['IdCarrera']);
			break;
		case 'modificar':
			$cuatrimestre->modificar($_POST['IdCuatrimestre'],$_POST['Cuatrimestre'],$_POST['IdCarrera']);
			break;
		case 'eliminar':
			$cuatrimestre->eliminar($_POST['IdNota']);
			break;
	}
?>
