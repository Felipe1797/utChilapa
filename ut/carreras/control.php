<?php
	include("modelo.php");
	$carrera = new modelo();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$carrera->cinicial($_POST['vals']);
			break;
		case 'agregar':
			$carrera->agregar($_POST['Nombre']);
			break;
		case 'modificar':
			$carrera->modificar($_POST['IdCarrera'],$_POST['Nombre']);
			break;
		case 'eliminar':
			$carrera->eliminar($_POST['IdNota']);
			break;
	}
?>
