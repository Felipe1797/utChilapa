<?php
	include("modelSeguimientoEgresados.php");
	$seguimiento = new modelSeguimientoEgresados();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$seguimiento->cinicial($_POST['vals']);
			break;
		case 'agregar':
			$seguimiento->agregar($_POST['Nombre'],$_POST['Testimonio']);
			break;
		case 'modificar':
			$seguimiento->modificar($_POST['IdSeguimiento'],$_POST['Nombre'],$_POST['Testimonio'],$_POST['Activo']);
			break;
		case 'eliminar':
			$seguimiento->eliminar($_POST['IdNota']);
			break;
	}
?>
