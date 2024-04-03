<?php
	include("modelconvocatoria.php");
	$calendarioescolar = new modelconvocatoria();
	switch($_POST['opcion'])
	{
		case 'cinicial':
			$convocatoria->cinicial($_POST['vals']);
			break;
		case 'eliminar':
			$convocatoria->eliminar($_POST['IdNota'], $_POST['RutaImg']);
			break;
	}
?>
