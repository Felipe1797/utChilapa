<?php
	include("modelOfertaEducativa.php");
	$universidad = new modelOfertaEducativa();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$universidad->cinicial($_POST['vals']);
			break;
		case 'agregar':
			$universidad->agregar($_POST['Tipo'],$_POST['Descripcion'],$_POST['IdCarrera']);
			break;
		case 'modificar':
			$universidad->modificar($_POST['IdUni'],$_POST['Tipo'],$_POST['Descripcion'],$_POST['IdCarrera']);
			break;
		case 'eliminar':
			$universidad->eliminar($_POST['IdNota']);
			break;
	}
?>
