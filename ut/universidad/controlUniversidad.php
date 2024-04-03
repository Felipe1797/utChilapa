<?php
	include("modelUniversidad.php");
	$universidad = new modelUniversidad();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$universidad->cinicial($_POST['vals']);
			break;
		case 'agregar':
			$universidad->agregar($_POST['Tipo'],$_POST['Descripcion']);
			break;
		case 'modificar':
			$universidad->modificar($_POST['IdUni'],$_POST['Tipo'],$_POST['Descripcion']);
			break;
		case 'eliminar':
			$universidad->eliminar($_POST['IdNota']);
			break;
	}
?>
