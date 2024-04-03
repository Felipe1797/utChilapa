<?php
	include("modelTitulo.php");
	$titulo = new modelTitulo();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$titulo->cinicial($_POST['vals']);
			break;
		case 'cinicial2':
			$titulo->cinicial2($_POST['vals']);
			break;
		case 'ccargo':
			$titulo->ccargo();
			break;
		case 'ccargo2':
			$titulo->ccargo2();
			break;
		case 'agregar':
			$titulo->agregar($_POST['Matricula'],$_POST['Nombre'],$_POST['Carrera'],$_POST['Estado'],$_POST['Observaciones']);
			break;
		case 'agregar2':
			$titulo->agregar2($_POST['Nombre']);
			break;
		case 'modificar':
			$titulo->modificar($_POST['Matricula'],$_POST['Nombre'],$_POST['Carrera'],$_POST['Estado'],$_POST['Observaciones'],$_POST['Activo']);
			break;
		case 'modificar2':
			$titulo->modificar2($_POST['IdCargo'],$_POST['Nombre']);
			break;
		case 'eliminar':
			$titulo->eliminar($_POST['Matricula']);
			break;
		case 'eliminar2':
			$titulo->eliminar2($_POST['IdCargo']);
			break;
	}
?>
