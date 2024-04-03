<?php
	include("modelDirectorio.php");
	$directorio = new modelDirectorio();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$directorio->cinicial($_POST['vals']);
			break;
		case 'cinicial2':
			$directorio->cinicial2($_POST['vals']);
			break;
		case 'ccargo':
			$directorio->ccargo();
			break;
		case 'ccargo2':
			$directorio->ccargo2();
			break;
		case 'agregar':
			$directorio->agregar($_POST['Nombre'],$_POST['IdCargo'],$_POST['Email'],$_POST['TelExt']);
			break;
		case 'agregar2':
			$directorio->agregar2($_POST['Nombre'],$_POST['Nivel']);
			break;
		case 'modificar':
			$directorio->modificar($_POST['IdDirectivo'],$_POST['Nombre'],$_POST['IdCargo'],$_POST['Email'],$_POST['Activo'],$_POST['TelExt']);
			break;
		case 'modificar2':
			$directorio->modificar2($_POST['IdCargo'],$_POST['Nombre'],$_POST['Nivel']);
			break;
		case 'eliminar':
			$directorio->eliminar($_POST['IdDirectivo']);
			break;
		case 'eliminar2':
			$directorio->eliminar2($_POST['IdCargo']);
			break;
	}
?>
