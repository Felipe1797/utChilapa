<?php
	include("model.php");
	$estadia = new model();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$estadia->cinicial($_POST['vals']);
			break;
		case 'agregar':
			$estadia->agregar($_POST['Tipo'],$_POST['Descripcion']);
			break;
		case 'modificar':
			$estadia->modificar($_POST['IdUni'],$_POST['Tipo'],$_POST['Descripcion']);
			break;
		case 'eliminar':
			$estadia->eliminar($_POST['IdNota']);
			break;
	}
?>
